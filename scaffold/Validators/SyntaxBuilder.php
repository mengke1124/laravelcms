<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */
 
namespace Cms\Generator\Validators;

class SyntaxBuilder
{

    /**
     * Create the PHP syntax for the given schema.
     *
     * @param  array $schema
     * @param  array $meta
     * @param  string $type
     * @param  bool $illuminate
     * @return string
     * @throws GeneratorException
     * @throws \Exception
     */
    public function create($schema)
    {
        $fieldsc = $this->createSchemaForValidation($schema);
        return $fieldsc;
    }

    private function createSchemaForValidation($schema)
    {
        $validator = '';
        if(is_array($schema)) {
            foreach ($schema as $s) {
                $validator .= "'" . $s['name'] . "' => '";

                #deal with the different format of the console
                if(isset($s['arguments'][0]) && $s['arguments'][0] != null ) {
                    $validator .= str_replace(")", "", str_replace("(", ":", $s['arguments'][0]));
                    $validator .= "',\n\t\t\t";
                }
            }
            return $validator;
        }
    }
}
