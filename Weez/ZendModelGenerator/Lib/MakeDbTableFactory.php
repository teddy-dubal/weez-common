<?php

namespace Weez\ZendModelGenerator\Lib;

use Weez\ZendModelGenerator\Lib\MakeDbTableAbstract;

/**
 * main class for files creation
 */
abstract class MakeDbTableFactory extends MakeDbTableAbstract
{

    /**
     *   @var int $zfv;
     */
    protected $zfv;

    /**
     *   @var Boolean $_addRequire;
     */
    protected $_addRequire;

    /**
     *   @var String $_includePath;
     */
    protected $_includePath;

    public function setIncludePath($path)
    {
        $this->_includePath = $path;
    }

    /**
     *
     * @return string
     */
    public function getIncludePath()
    {
        return $this->_includePath;
    }

    /**
     *
     *  the class constructor
     *
     * @param Array $config
     * @param String $dbname
     * @param String $namespace
     */
    public function __construct($config, $dbname, $namespace, $zfv = 1)
    {
        parent::__construct($config, $dbname, $namespace);
        $this->zfv = $zfv;
        if (1 == $zfv) {
            $this->setTemplatePath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'templates-v1');
        } else {
            $this->setTemplatePath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'templates-v2');
        }
        $this->_addRequire = $config['include.addrequire'];
        $path              = $this->_config['include.path'];


        if (!is_dir($path)) {
            // Use path relative to root of the application
            $path = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $this->_config['include.path'];
        }

        $this->setIncludePath($path . DIRECTORY_SEPARATOR);

        if (file_exists($this->getIncludePath() . 'IncludeDefault.php')) {
            require_once $this->getIncludePath() . 'IncludeDefault.php';
        } else {
            require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'IncludeDefault.php';
        }
    }

    /**
     * creates the DbTable class file
     */
    public function makeDbTableFile()
    {

        $class = 'DbTable\\' . $this->_className;
        $file  = $this->getIncludePath() . $class . '.inc.php';
        if (file_exists($file)) {
            include_once $file;
            $include             = new $class($this->_namespace);
            $this->_includeTable = $include;
        } else {
            $this->_includeTable = new DbTable_Default($this->_namespace);
        }

        $referenceMap = '';
        $dbTableFile  = $this->getLocation() . DIRECTORY_SEPARATOR . 'DbTable' . DIRECTORY_SEPARATOR . $this->_className . '.php';

        $foreignKeysInfo       = $this->getForeignKeysInfo();
        $references            = array();
        $classDbTableNamespace = $this->_namespace . '\Model\DbTable\\';
        foreach ($foreignKeysInfo as $info) {
            $refTableClass = $classDbTableNamespace . $this->_getClassName($info['foreign_tbl_name']);
            $key           = $this->_getCapital($info['key_name']);
            if (is_array($info['column_name'])) {
                $columns = 'array(\'' . implode("', '", $info['column_name']) . '\')';
            } else {
                $columns = "'" . $info['column_name'] . "'";
            }
            if (is_array($info['foreign_tbl_column_name'])) {
                $refColumns = 'array(\'' . implode("', '", $info['foreign_tbl_column_name']) . '\')';
            } else {
                $refColumns = "'" . $info['foreign_tbl_column_name'] . "'";
            }

            $references[] = "
        '$key' => array(
          	'columns' => {$columns},
            'refTableClass' => '{$refTableClass}',
            'refColumns' => {$refColumns}
        )";
        }

        if (sizeof($references) > 0) {
            $referenceMap = "protected \$_referenceMap = array(" .
                    join(',', $references) . "\n    );";
        }

        $dependentTables = '';
        $dependents      = array();
        foreach ($this->getDependentTables() as $info) {
            $dependents[] = '\\' . $classDbTableNamespace . $this->_getClassName($info['foreign_tbl_name']);
        }

        if (sizeof($dependents) > 0) {
            $dependentTables = "protected \$_dependentTables = array(\n        '" .
                    join("',\n        '", $dependents) . "'\n    );";
        }

        $vars = array('referenceMap' => $referenceMap, 'dependentTables' => $dependentTables);

        $dbTableData = $this->getParsedTplContents('dbtable.tpl', $vars);

        if (!file_put_contents($dbTableFile, $dbTableData))
            die("Error: could not write db table file $dbTableFile.");
    }

    /**
     * creates the Mapper class file
     */
    public function makeMapperFile()
    {

        $class = 'Mapper_' . $this->_className;
        $file  = $this->getIncludePath() . $class . '.inc.php';
        if (file_exists($file)) {
            include_once $file;
            $include              = new $class($this->_namespace);
            $this->_includeMapper = $include;
        } else {
            $this->_includeMapper = new Mapper_Default($this->_namespace);
        }

        $mapperFile = $this->getLocation() . DIRECTORY_SEPARATOR . 'Mapper' . DIRECTORY_SEPARATOR . $this->_className . '.php';

        $mapperData = $this->getParsedTplContents('mapper.tpl');

        if (!file_put_contents($mapperFile, $mapperData)) {
            die("Error: could not write mapper file $mapperFile.");
        }
    }

    /**
     * creates the model class file
     */
    public function makeModelFile()
    {

        $class = 'Model\\' . $this->_className;
        $file  = $this->getIncludePath() . $class . '.inc.php';
        if (file_exists($file)) {
            include_once $file;
            $include             = new $class($this->_namespace);
            $this->_includeModel = $include;
        } else {
            $this->_includeModel = new Model_Default($this->_namespace);
        }

        $modelFile = $this->getLocation() . DIRECTORY_SEPARATOR . $this->_className . '.php';

        $modelData = $this->getParsedTplContents('model.tpl');

        if (!file_put_contents($modelFile, $modelData)) {
            die("Error: could not write model file $modelFile.");
        }
    }

    public function doItAll()
    {
        if (1 == $this->zfv) {
            $this->doItAllZf1();
        } else {
            $this->doItAllZf2();
        }
    }

    /**
     *
     * creates all class files
     *
     * @return Boolean
     */
    private function doItAllZf1()
    {

        $this->makeDbTableFile();
        $this->makeMapperFile();
        $this->makeModelFile();

        $modelFile = $this->getLocation() . DIRECTORY_SEPARATOR . 'ModelAbstract.php';
        $modelData = $this->getParsedTplContents('model_class.tpl');

        if (!file_put_contents($modelFile, $modelData))
            die("Error: could not write model file $modelFile.");

        $paginatorFile = $this->getLocation() . DIRECTORY_SEPARATOR . 'Paginator.php';
        $paginatorData = $this->getParsedTplContents('paginator_class.tpl');

        if (!file_put_contents($paginatorFile, $paginatorData))
            die("Error: could not write model file $paginatorFile.");

        $mapperFile = $this->getLocation() . DIRECTORY_SEPARATOR . 'Mapper' . DIRECTORY_SEPARATOR . 'MapperAbstract.php';
        $mapperData = $this->getParsedTplContents('mapper_class.tpl');

        if (!file_put_contents($mapperFile, $mapperData))
            die("Error: could not write mapper file $mapperFile.");

        $tableFile = $this->getLocation() . DIRECTORY_SEPARATOR . 'DbTable' . DIRECTORY_SEPARATOR . 'TableAbstract.php';
        $tableData = $this->getParsedTplContents('dbtable_class.tpl');

        if (!file_put_contents($tableFile, $tableData))
            die("Error: could not write model file $tableFile.");

        // Copy all files in include paths
        if (is_dir($this->getIncludePath() . 'model')) {
            $this->copyIncludeFiles($this->getIncludePath() . 'model', $this->getLocation());
        }

        if (is_dir($this->getIncludePath() . 'mapper')) {
            $this->copyIncludeFiles($this->getIncludePath() . 'mapper', $this->getLocation() . 'Mapper');
        }

        if (is_dir($this->getIncludePath() . 'dbtable')) {
            $this->copyIncludeFiles($this->getIncludePath() . 'dbtable', $this->getLocation() . 'DbTable');
        }

        /* 		$templatesDir=realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'templates').DIRECTORY_SEPARATOR;

          if (!file_put_contents($modelFile,$modelData))
          die("Error: could not write model file $modelFile.");

          if (!copy($templatesDir.'model_class.tpl',$this->getLocation().DIRECTORY_SEPARATOR.'MainModel.php'))
          die("could not copy model_class.tpl as MainModel.php");
          if (!copy($templatesDir.'dbtable_class.tpl',$this->getLocation().DIRECTORY_SEPARATOR.'DbTable'.DIRECTORY_SEPARATOR.'MainDbTable.php'))
          die("could not copy dbtable_class.php as MainDbTable.php");
         */
        return true;
    }

    protected function copyIncludeFiles($dir, $dest)
    {
        $files     = array();
        $directory = opendir($dir);

        while ($item = readdir($directory)) {
            // Ignore hidden files ('.' as first character)
            if (preg_match('/^\./', $item)) {
                continue;
            }

            copy($dir . DIRECTORY_SEPARATOR . $item, $dest . DIRECTORY_SEPARATOR . $item);
        }
        closedir($directory);
    }

    private function doItAllZf2()
    {
        $entityData = $this->getParsedTplContents('Entity.phtml');
        $entityFile = $this->getLocation() . DIRECTORY_SEPARATOR . "Entity" . DIRECTORY_SEPARATOR . "Entity.php";

        $managerData = $this->getParsedTplContents('Manager.phtml');
        $managerFile = $this->getLocation() . DIRECTORY_SEPARATOR . "Table" . DIRECTORY_SEPARATOR . "Manager.php";

        $fooFile = $this->getLocation() . DIRECTORY_SEPARATOR . "Entity" . DIRECTORY_SEPARATOR . $this->_className . ".php";
        $fooData = $this->getParsedTplContents('Foo.phtml');

        $fooTableFile = $this->getLocation() . DIRECTORY_SEPARATOR . "Table" . DIRECTORY_SEPARATOR . $this->_className . "Table.php";
        $fooTableData = $this->getParsedTplContents('FooTable.phtml');

        $templatesDir = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'templates-v2') . DIRECTORY_SEPARATOR;
        if (null != $twig         = $this->getTwig()) {
            $var = get_object_vars($this);

            $foreignKeysInfo          = $this->getForeignKeysInfo();
            $dependentTables          = $this->getDependentTables();
            $getRelationNameParent    = array();
            $getRelationNameDependent = array();
            $getCapital               = array();
            $getClassName             = array();
            foreach ($foreignKeysInfo as $key) {
                echo $key['key_name'];
                echo $getRelationNameParent[$key['key_name']]            = $this->_getRelationName($key, 'parent');
                $getRelationNameDependent[$key['key_name']]         = $this->_getRelationName($key, 'dependent');
                $getCapital[$key['key_name']]                       = $this->_getCapital($key['key_name']);
                $getClassName[$key['key_name']]['foreign_tbl_name'] = $this->_getClassName($key['foreign_tbl_name']);
                $getClassName[$key['key_name']]['column_name']      = $this->_getClassName($key['column_name']);
            }
            $twig_var = array(
                'namespace'                => $var['_namespace'],
                'className'                => $var['_className'],
                'columns'                  => $var['_columns'],
                'foreignKeysInfo'          => $foreignKeysInfo,
                'dependentTables'          => $dependentTables,
                'getRelationNameParent'    => $getRelationNameParent,
                'getRelationNameDependent' => $getRelationNameDependent,
                'getCapital'               => $getCapital,
                'getClassName'             => $getClassName,
            );
        }
        if (!file_put_contents($entityFile, $twig->render('Entity.php.twig', $twig_var)))
            die("Error: could not write Entity file $entityFile.");
//        if (!file_put_contents($managerFile, $managerData))
//            die("Error: could not write Manager file $managerFile.");
//        if (!file_put_contents($fooFile, $fooData))
        if (!file_put_contents($fooFile, $twig->render('Foo.php.twig', $twig_var)))
            die("Error: could not write model file $fooFile.");
//        if (!file_put_contents($fooTableFile, $fooTableData))
//            die("Error: could not write model file $fooFile.");
        return true;
    }

}
