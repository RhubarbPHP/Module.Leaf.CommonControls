<?php

namespace Rhubarb\Leaf\Controls\Common\Examples\SelectionControls;

use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlEnumColumn;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;
use Rhubarb\Stem\Schema\ModelSchema;

class ExampleContact extends Model
{
    /**
     * Returns the schema for this data object.
     *
     * @return \Rhubarb\Stem\Schema\ModelSchema
     */
    protected function createSchema()
    {
        $schema = new ModelSchema('Contact');
        $schema->addColumn(
            new AutoIncrementColumn('ContactID'),
            new StringColumn('FirstName', 100),
            new StringColumn('Surname', 100),
            new StringColumn('City', 50),
            new MySqlEnumColumn('Status', 'New', ['New', 'Processing', 'Processed'])
        );

        $schema->labelColumnName = 'Name';

        return $schema;
    }

    public function getName()
    {
        return $this->FirstName.' '.$this->Surname;
    }

    protected function getPublicPropertyList()
    {
        $list = parent::getPublicPropertyList();
        $list[] = 'FirstName';
        $list[] = 'Surname';

        return $list;
    }
}