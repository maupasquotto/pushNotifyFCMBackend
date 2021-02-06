<?php











namespace Composer;

use Composer\Semver\VersionParser;






class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => '1.0.1',
    'version' => '1.0.1.0',
    'aliases' => 
    array (
    ),
    'reference' => NULL,
    'name' => 'phpmv/ubiquity-project',
  ),
  'versions' => 
  array (
    'frameworks/jquery' => 
    array (
      'pretty_version' => '2.1.4',
      'version' => '2.1.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ef9c4fe9fcb23914bba6ec6d32c556e4a38a0fd9',
    ),
    'mindplay/annotations' => 
    array (
      'pretty_version' => '1.3.2',
      'version' => '1.3.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '7e1547259a6aa7e3abc3832207499943614e9d13',
    ),
    'phpmv/php-mv-ui' => 
    array (
      'pretty_version' => '2.3.17',
      'version' => '2.3.17.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e38ed86d7a756be41658229e35a2931710cdf3f2',
    ),
    'phpmv/ubiquity' => 
    array (
      'pretty_version' => '2.3.5',
      'version' => '2.3.5.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f3f2b9ab95a76c72bd54d697c46f56a571127f48',
    ),
    'phpmv/ubiquity-codeception' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '74e44a9a46ab63d6c0dd27b520d7bb952984e108',
    ),
    'phpmv/ubiquity-dev' => 
    array (
      'pretty_version' => '0.0.6',
      'version' => '0.0.6.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b660fc2b2050ae61c9a06e7ba9331a571fe50dc7',
    ),
    'phpmv/ubiquity-devtools' => 
    array (
      'pretty_version' => '1.2.13',
      'version' => '1.2.13.0',
      'aliases' => 
      array (
      ),
      'reference' => 'bef155d3e1d5a1beba004fd4ffe68e3ca54ad9c4',
    ),
    'phpmv/ubiquity-project' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => NULL,
    ),
    'phpmv/ubiquity-webtools' => 
    array (
      'pretty_version' => '2.3.6',
      'version' => '2.3.6.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ed27bad951837205d3ca52f72747b84a9fe67224',
    ),
    'symfony/polyfill-ctype' => 
    array (
      'pretty_version' => 'v1.22.0',
      'version' => '1.22.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c6c942b1ac76c82448322025e084cadc56048b4e',
    ),
    'symfony/polyfill-mbstring' => 
    array (
      'pretty_version' => 'v1.22.0',
      'version' => '1.22.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f377a3dd1fde44d37b9831d68dc8dea3ffd28e13',
    ),
    'twig/twig' => 
    array (
      'pretty_version' => 'v2.14.3',
      'version' => '2.14.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '8bc568d460d88b25c00c046256ec14a787ea60d9',
    ),
  ),
);







public static function getInstalledPackages()
{
return array_keys(self::$installed['versions']);
}









public static function isInstalled($packageName)
{
return isset(self::$installed['versions'][$packageName]);
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

$ranges = array();
if (isset(self::$installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = self::$installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}





public static function getVersion($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['version'])) {
return null;
}

return self::$installed['versions'][$packageName]['version'];
}





public static function getPrettyVersion($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return self::$installed['versions'][$packageName]['pretty_version'];
}





public static function getReference($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['reference'])) {
return null;
}

return self::$installed['versions'][$packageName]['reference'];
}





public static function getRootPackage()
{
return self::$installed['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
}
}
