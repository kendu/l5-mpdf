<?php
namespace Kendu\Mpdf;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Config;

include base_path('vendor/mpdf/mpdf/mpdf.php');


class ServiceProvider extends BaseServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('mpdf.wrapper', function($app,$cfg)  {
            $app['mpdf.pdf'] = $app->share(function($app) use($cfg){

                    if( ! empty($cfg))
                    {
                        foreach($cfg as $key => $value)
                        {
                            Config::set('pdf.'.$key, $value);
                        }
                    }

                    $mpdf=new \mPDF(
                        Config::get('pdf.mode'),
                        Config::get('pdf.format'),
                        Config::get('pdf.defaultFontSize'),
                        Config::get('pdf.defaultFont'),
                        Config::get('pdf.marginLeft'),
                        Config::get('pdf.marginRight'),
                        Config::get('pdf.marginTop'),
                        Config::get('pdf.marginBottom'),
                        Config::get('pdf.marginHeader'),
                        Config::get('pdf.marginFooter'),
                        Config::get('pdf.orientation')
                    );
                    $mpdf->SetProtection(array('print'));
                    $mpdf->SetTitle(Config::get('pdf.title'));
                    $mpdf->SetAuthor(Config::get('pdf.author'));
                    $mpdf->SetWatermarkText(Config::get('pdf.watermark'));
                    $mpdf->showWatermarkText = Config::get('pdf.showWatermark');
                    $mpdf->watermark_font = Config::get('pdf.watermarkFont');
                    $mpdf->watermarkTextAlpha = Config::get('pdf.watermarkTextAlpha');
                    $mpdf->SetDisplayMode(Config::get('pdf.displayMode'));

                return $mpdf;
            });

            return new PdfWrapper($app['mpdf.pdf']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('mpdf.pdf');
    }

}
