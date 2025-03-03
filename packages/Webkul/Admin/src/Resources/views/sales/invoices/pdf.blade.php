<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">
<head>
    <!-- meta tags -->
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    @php
        $fontPath = [];
        $getLocale = app()->getLocale();
        $currencyCode = core()->getBaseCurrencyCode();

        if ($getLocale == 'en' && $currencyCode == 'INR') {
            $fontFamily = ['regular' => 'DejaVu Sans', 'bold' => 'DejaVu Sans'];
        } else {
            $fontFamily = ['regular' => 'Arial, sans-serif', 'bold' => 'Arial, sans-serif'];
        }

        if (in_array($getLocale, ['ar', 'he', 'fa', 'tr', 'ru', 'uk'])) {
            $fontFamily = ['regular' => 'DejaVu Sans', 'bold' => 'DejaVu Sans'];
        } elseif ($getLocale == 'zh_CN') {
            $fontPath = ['regular' => asset('fonts/NotoSansSC-Regular.ttf'), 'bold' => asset('fonts/NotoSansSC-Bold.ttf')];
            $fontFamily = ['regular' => 'Noto Sans SC', 'bold' => 'Noto Sans SC Bold'];
        } elseif ($getLocale == 'ja') {
            $fontPath = ['regular' => asset('fonts/NotoSansJP-Regular.ttf'), 'bold' => asset('fonts/NotoSansJP-Bold.ttf')];
            $fontFamily = ['regular' => 'Noto Sans JP', 'bold' => 'Noto Sans JP Bold'];
        } elseif ($getLocale == 'hi_IN') {
            $fontPath = ['regular' => asset('fonts/Hind-Regular.ttf'), 'bold' => asset('fonts/Hind-Bold.ttf')];
            $fontFamily = ['regular' => 'Hind', 'bold' => 'Hind Bold'];
        } elseif ($getLocale == 'bn') {
            $fontPath = ['regular' => asset('fonts/NotoSansBengali-Regular.ttf'), 'bold' => asset('fonts/NotoSansBengali-Bold.ttf')];
            $fontFamily = ['regular' => 'Noto Sans Bengali', 'bold' => 'Noto Sans Bengali Bold'];
        } elseif ($getLocale == 'sin') {
            $fontPath = ['regular' => asset('fonts/NotoSansSinhala-Regular.ttf'), 'bold' => asset('fonts/NotoSansSinhala-Bold.ttf')];
            $fontFamily = ['regular' => 'Noto Sans Sinhala', 'bold' => 'Noto Sans Sinhala Bold'];
        }
    @endphp

<style type="text/css">
    @if (! empty($fontPath['regular']))
        @font-face {
            src: url({{ $fontPath['regular'] }}) format('truetype');
            font-family: {{ $fontFamily['regular'] }};
        }
    @endif
    
    @if (! empty($fontPath['bold']))
        @font-face {
            src: url({{ $fontPath['bold'] }}) format('truetype');
            font-family: {{ $fontFamily['bold'] }};
            font-style: bold;
        }
    @endif
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: {{ $fontFamily['regular'] }};
    }

    body {
        font-size: 9px; /* Increased from 8px */
        color: #091341;
        font-family: "{{ $fontFamily['regular'] }}";
        width: 58mm;
        margin: 0 auto;
    }

    b, th {
        font-family: "{{ $fontFamily['bold'] }}";
    }

    .page-content {
        padding: 10px;
        width: 58mm;
        margin: 0 auto;
    }

    .page-header {
        border-bottom: 1px solid #E9EFFC;
        text-align: center;
        font-size: 16px;
        text-transform: uppercase;
        color: #000DBB;
        padding: 14px 0;
        margin: 0;
    }

    .logo-container {
        text-align: center;
        margin-bottom: 4mm;
    }

    .logo-container img {
        max-width: 12mm;
        height: auto;
        margin-bottom: 3mm;
    }

    .header-title {
        font-size: 6mm;
        font-weight: bold;
        margin: 3mm 0;
    }

    .info-row {
        display: flex;
        font-size: 3.5mm; /* Increased from 3mm */
        margin-bottom: 1.5mm;
    }

    .info-label {
        font-weight: bold;
        width: 40%;
    }

    .info-value {
        width: 60%;
    }

    .divider {
        border-top: 1px dashed #000;
        margin: 3mm 0;
    }

    .section-title {
        font-weight: bold;
        font-size: 4mm; /* Increased from 3.5mm */
        margin: 2.5mm 0;
    }

    .item {
        margin-bottom: 2.5mm;
        font-size: 3.5mm; /* Increased from 3mm */
    }

    .item-name {
        font-weight: bold;
    }

    .item-details {
        display: flex;
        justify-content: space-between;
    }

    .totals {
        margin-top: 3mm;
    }

    .total-row {
        display: flex;
        font-size: 3.5mm; /* Increased from 3mm */
    }

    .total-row.final {
        font-weight: bold;
        font-size: 4mm; /* Increased from 3.5mm */
    }

    .footer {
        text-align: center;
        font-size: 3.5mm; /* Increased from 3mm */
        margin-top: 5mm;
    }

    /* Aumentar el tamaño de texto para clases específicas */
    .text-[10px] {
        font-size: 3.5mm; /* Aproximadamente 10px */
    }

    .text-[9px] {
        font-size: 3.2mm; /* Aproximadamente 9px */
    }
</style>
</head>

<body dir="{{ core()->getCurrentLocale()->direction }}">
    <div class="page">
        <div class="page-content">
            <div class="logo-container">
                @if (core()->getConfigData('sales.invoice_settings.pdf_print_outs.logo'))
                    @php
                        $logoRelativePath = core()->getConfigData('sales.invoice_settings.pdf_print_outs.logo');
                        $logoPath = storage_path('app/public/' . $logoRelativePath);
                    @endphp
            
                    @if (file_exists($logoPath))
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents($logoPath)) }}" alt="Logo"/>
                    @else
                        <p>Logo not found at: {{ $logoPath }}</p>
                    @endif
                @else
                    <p>No logo configured</p>
                @endif
            </div>

            <div class="text-center font-bold border-y border-dashed border-gray-400 py-1 mb-2">FACTURA</div>

            <div class="mb-1 text-[10px]">
                <div class="info-row">
                    <span class="info-label">Factura:</span>
                    <span class="info-value">#{{ $invoice->increment_id ?? $invoice->id }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Fecha:</span>
                    <span class="info-value">{{ core()->formatDate($invoice->created_at, 'd-m-Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Pedido:</span>
                    <span class="info-value">#{{ $invoice->order->increment_id }}</span>
                </div>
            </div>

            <div class="divider"></div>
            <div class="section-title">PRODUCTOS:</div>
            <div>
                @foreach ($invoice->items as $item)
                    <div class="item">
                        <div class="item-details">
                            <span>{{ $item->qty }} x {{ $item->name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="divider"></div>
            <div class="totals">
                <div class="total-row final">
                    <span>TOTAL ORDEN:</span>
                    <span>{{ $invoice->total_qty }}</span>
                </div>
            </div>

            <div class="footer">
                <p>¡Gracias por su compra!</p>
                <p class="mt-1">www.pksmarket.com</p>
            </div>
        </div>
    </div>
</body>
</html>