<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title_pdf; ?></title>
    <style>
        @media print {
            @page {
                size: landscape;
                margin: 20mm 0 0 0;
            }

            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }

            .page {
                display: flex;
                justify-content: center;
                align-items: center;
                box-sizing: border-box;
                page-break-after: always;
            }

            .page:last-child {
                page-break-after: auto; /* Avoid page break after the last .page */
            }

            table {
                width: 100%;
                height: 100%;
                border-collapse: collapse;
                table-layout: fixed;
                text-align: center;
            }

            td {
                padding: 0; /* Adjust padding */
            }

            .barcode-label img {
                max-width: 100%;
                height: auto;
            }

            h4, h5, h6 {
                margin: 2mm 0; /* Adjust margin for headings */
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <?php if (!empty($material_codes)) : ?>
            <?php foreach ($material_codes as $index => $data) : ?>
                <div class="page">
                    <table>
                        <tr>
                            <td colspan="2">
                                <h4><?= $data['code_material'] ?></h4>
                                <h6><?= $data['specification_material'] ?></h6>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 0;">
                                <?php
                                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                $barcode_image = 'data:image/png;base64,' . base64_encode($generator->getBarcode($data['code_material'], $generator::TYPE_CODE_128, 1));
                                echo '<img src="' . $barcode_image . '" class="barcode-label">';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <h5>Location: <?= $data['name_location'] ?></h5>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No material codes available.</p>
        <?php endif; ?>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>