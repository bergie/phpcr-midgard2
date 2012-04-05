<?php
namespace Midgard\PHPCR\NodeType;
use PHPCR\NodeType\NodeTypeDefinitionInterface;
use PHPCR\NodeType\NodeTypeTemplateInterface;
use PHPCR\RepositoryException;
use \ArrayObject;

class NodeTypeTemplate extends NodeTypeDefinition implements NodeTypeTemplateInterface
{
    public function __construct(NodeTypeDefinitionInterface $ntt = null, NodeTypeManager $manager)
    {
        if (!$ntt) {
            return parent::__construct(null, $manager);
        }

        parent::__construct($ntt->getName(), $manager);
        $this->childNodeDefinitions = $ntt->getDeclaredChildNodeDefinitions();
        $propdefs = $ntt->getDeclaredPropertyDefinitions();
        if ($propdefs == null) {
            $propdefs = array();
        }
        $this->propertyDefinitions = new ArrayObject($propdefs);
        $this->supertypeNames = $ntt->getDeclaredSuperTypeNames();
        $this->primaryItemName = $ntt->getPrimaryItemName();
        $this->hasOrderableChildNodes = $ntt->hasOrderableChildNodes();
        $this->isAbstract = $ntt->isAbstract();
        $this->isMixin = $ntt->isMixin();
        $this->isQueryable = $ntt->isQueryable();
    }

    public function getNodeDefinitionTemplates()
    {
        return new ArrayObject();       
    }

    public function getPropertyDefinitionTemplates()
    {
        return $this->propertyDefinitions;
    }

    public function setAbstract($toggle)
    {
        $this->isAbstract = $toggle;
    }

    public function setDeclaredSuperTypeNames(array $names)
    {
        $this->supertypeNames = $names;
    }

    public function setMixin($toggle)
    {
        $this->isMixin = $toggle;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setOrderableChildNodes($toggle)
    {
        $this->hasOrderableChildNodes = $toggle;
    }

    public function setPrimaryItemName($name)
    {
        $this->primaryItemName = $name;
    }

    public function setQueryable($toggle)
    {
        $this->isQueryable = $toggle;
    }
}

