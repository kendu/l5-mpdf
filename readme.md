### mPDF Wrapper for Laravel 5

## Installation
Begin by installing this package through Composer. Edit your project's `composer.json` file to require `kendu/l5-mpdf`.

```json
{
  "require": {
       "kendu/l5-mpdf" : "*@dev"
    }
}
```

Next, update Composer from the Terminal:
```bash
$ composer update
```

Alternatively, install the package only without updating every other package in composer:
```bash
$ composer require kendu/l5-mpdf
```

Once this operation completes, the final step is to add the service provider. Open `app/config/app.php`, and add a new item to the providers array.
```php
'Kendu\Mpdf\ServiceProvider',
```

You can also register facade.


```php
'PDF' => 'Kendu\Mpdf\Facades\Pdf',
```

### Usage
All the wrapper methods are available in PdfWrapper.php <br />
The PDF constructor takes in a mPDF instance. So create a new mPDF instance first

```php
$mPdf = new mPDF('utf-8');
```

Note: setup all custom paging-related settings for mPDF now if any. things like:
```php
$mPdf->mirrorMargins = 1
$mPdf->SetTitle('title');
... etc
```

Create a new PDF instance with the mPDF instance, and then run the wrapper methods to output.
```php
$pdf = new PDF($mPdf);
$pdf->loadView('pdf.blade.view', ['params' => $params]);
$pdf->download('test.pdf');
// or if you wish to stream the output in browser instead of download:
$pdf->stream('test.pdf');
```
### License

This mPDF Wrapper for Laravel5 is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
