<?php
namespace Kendu\Mpdf;

/**
 * A Laravel wrapper for mPDF
 *
 * @package l4-mpdf
 * @author Kendu
 */
class PdfWrapper {

    /** @var \Mpdf  */
    protected $mpdf;
    protected $rendered = false;
    protected $options;

    public function __construct($mpdf){
       $this->mpdf = $mpdf;
       $this->options = array();
   }

    /**
     * Load a HTML string
     *
     * @param string $string
     * @return static
     */
    public function loadHTML($string, $mode = 0){
        $this->mpdf->WriteHTML((string) $string, $mode);
        $this->html = null;
        $this->file = null;
        return $this;
    }

    /**
     * Load a HTML file
     *
     * @param string $file
     * @return static
     */
    public function loadFile($file){
        $this->html = null;
        $this->file = $file;
        return $this;
    }

    /**
     * Load a View and convert to HTML
     *
     * @param string $view
     * @param array $data
     * @param array $mergeData
     * @return static
     */
    public function loadView($view, $data = array(), $mergeData = array()){
        $this->html = \View::make($view, $data, $mergeData)->render();
        $this->file = null;
        return $this;
    }



    /**
     * Output the PDF as a string.
     *
     * @return string The rendered PDF as string
     */
    public function output(){

        $errorlevel = error_reporting();
        error_reporting($errorlevel & ~E_NOTICE);

        if($this->html)
        {
            $this->mpdf->WriteHTML($this->html);
        }
        elseif($this->file)
        {
            $this->mpdf->WriteHTML($this->file);
        }

        $output = $this->mpdf->Output('', 'S');
        
        error_reporting($errorlevel);
    
        return $output;
    }

    /**
     * Save the PDF to a file
     *
     * @param $filename
     * @return static
     */
    public function save($filename){

        $errorlevel = error_reporting();
        error_reporting($errorlevel & ~E_NOTICE);

        if($this->html)
        {
            $this->mpdf->WriteHTML($this->html);
        }
        elseif($this->file)
        {
            $this->mpdf->WriteHTML($this->file);
        }

        $output = $this->mpdf->Output($filename, 'F');
        
        error_reporting($errorlevel);
    
        return $output;
    }

    /**
     * Make the PDF downloadable by the user
     *
     * @param string $filename
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function download($filename = 'document.pdf' ){

        $errorlevel = error_reporting();
        error_reporting($errorlevel & ~E_NOTICE);

        if($this->html)
        {
            $this->mpdf->WriteHTML($this->html);
        }
        elseif($this->file)
        {
            $this->mpdf->WriteHTML($this->file);
        }

        $output = $this->mpdf->Output($filename, 'D');
        
        error_reporting($errorlevel);
    
        return $output;
    }

    /**
     * Return a response with the PDF to show in the browser
     *
     * @param string $filename
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function stream($filename = 'document.pdf' ){

        $errorlevel = error_reporting();
        error_reporting($errorlevel & ~E_NOTICE);

        if($this->html)
        {
            $this->mpdf->WriteHTML($this->html);
        }
        elseif($this->file)
        {
            $this->mpdf->WriteHTML($this->file);
        }

        $output = $this->mpdf->Output($filename, 'I');
        
        error_reporting($errorlevel);
    
        return $output;
    }

    public function __call($name, $arguments){
        return call_user_func_array (array( $this->mpdf, $name), $arguments);
    }

}
