<?php
/**
 * Created by PhpStorm.
 * User: Iriven
 * Date: 23/04/2016
 * Time: 00:23
 */


final class IrivenPhpBenchmark
{
    /**
     * List of all benchmark markers.
     * @var array
     * @access private
     */
    private $marker = array();
    private $dialog = [
        'default'=>'Page loaded in %s seconds',
        'relative'=>'Elapsed time between \'%s\' and \'%s\': %s seconds'
    ];

    /**
     * Constructeur.
     * Initialisation des valeurs
     *
     */
    public function __construct()
    {
        return $this->addMarker();
    }
    /**
     * Set a benchmark marker
     *
     * Multiple calls to this function can be made so that several
     * execution points can be timed.
     *
     * @param	string	$name	Marker name
     * @return Float
     */
    public function addMarker($name=null)
    {
        if(!$name)
            $name = !isset($this->marker['start'])?'start':'end';
        return $this->marker[$name] = $this->getMicrotime();
    }
    /**
     * Elapsed time
     *
     * Calculates the time difference between two marked points.
     *
     * @param	string	$markA		A particular marked point
     * @param	string	$markB		A particular marked point
     * @param	int	$decimals	Number of decimal places
     * @return string
     */
    public function getElapsedTime($markA = null, $markB = null, $decimals = 4)
    {
        if (!$markA or !$markB)
            return sprintf($this->dialog['default'],round($this->addMarker() - $this->marker['start'],$decimals,PHP_ROUND_HALF_UP));
        if ( ! isset($this->marker[$markA]))
            $this->marker[$markA] = $this->marker['start'];
        if ( ! isset($this->marker[$markB]))
            $this->addMarker($markB);
        return sprintf($this->dialog['relative'],$markA,$markB,round($this->marker[$markB] - $this->marker[$markA],$decimals,PHP_ROUND_HALF_UP));
    }
    /**
     * Donne les miliseconde
     * @access private
     * @return Float temps en milisecondes
     */
    private function getMicrotime()
    {
        $temps = microtime(true);
        $temps = explode(' ', $temps);
        $temps = $temps[1] + $temps[0];
        return (float)$temps;
    }

    /**
     * @param bool $html
     * @return array|string
     */
    public function getMarks($html=true)
    {
        $this->addMarker();
        if(!$html) return $this->marker;
        $output = '<ol id="benchmarkMarker">';
        foreach ($this->marker as $key=>$value)
            $output .= '<li>'.$key.': '.$value.' milisecondes</li>';
        $output .= '</ol>';
        return $output;
    }
}
