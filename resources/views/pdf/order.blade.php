<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>

        <style>
            .clearfix:after {
                content : "";
                display : table;
                clear   : both;
            }

            a {
                color           : #5D6975;
                text-decoration : underline;
            }

            body {
                position    : relative;
                margin      : 0 auto;
                color       : #001028;
                background  : #FFFFFF;
                font-family : Arial, sans-serif;
                font-size   : 12px;
                font-family : Arial;
            }

            header {
                padding       : 10px 0;
                margin-bottom : 30px;
            }

            #logo {
                text-align    : center;
                margin-bottom : 10px;
            }

            #logo img {
                width : 90px;
            }

            h1 {
                border-top    : 1px solid #5D6975;
                border-bottom : 1px solid #5D6975;
                color         : #5D6975;
                font-size     : 2.4em;
                line-height   : 1.4em;
                font-weight   : normal;
                text-align    : center;
                margin        : 0 0 20px 0;
                background    : url(dimension.png);
            }

            #project {
                float : left;
            }

            #project span {
                color        : #5D6975;
                text-align   : right;
                width        : 52px;
                margin-right : 10px;
                display      : inline-block;
                font-size    : 0.8em;
            }

            #company {
                float      : right;
                text-align : right;
            }

            #project div,
            #company div {
                white-space : nowrap;
            }

            table {
                width           : 100%;
                border-collapse : collapse;
                border-spacing  : 0;
                margin-bottom   : 20px;
            }

            table tr:nth-child(2n-1) td {
                background : #F5F5F5;
            }

            table th,
            table td {
                text-align : center;
            }

            table th {
                padding       : 5px 20px;
                color         : #5D6975;
                border-bottom : 1px solid #C1CED9;
                white-space   : nowrap;
                font-weight   : normal;
            }

            table .service,
            table td {
                padding    : 20px;
                text-align : right;
            }

            table td.service,
            table .service,
            table td.unit,
            table .unit,
            table td.desc {
                vertical-align : top;
                text-align     : left !important;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size : 1.2em;
            }

            table td.grand {
                border-top : 1px solid #5D6975;;
            }

            #notices .notice {
                color     : #5D6975;
                font-size : 1.2em;
            }

            footer {
                color      : #5D6975;
                width      : 100%;
                height     : 30px;
                position   : absolute;
                bottom     : 0;
                border-top : 1px solid #C1CED9;
                padding    : 8px 0;
                text-align : center;
            }
        </style>
    </head>
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="./images/logo.png">
            </div>
            <h1 style="text-transform: uppercase !important; ">Commande n°{{ $order->id }}</h1>
            <div id="project">
                <div><span>Client </span> {{ $order->delivery_name }}</div>
                <div><span>Adresse </span> {{ $order->delivery_address }}</div>
                <div><span>Ville </span> {{ $order->delivery_zipCode }} {{ $order->delivery_city }}</div>
            </div>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th class="service">Produit</th>
                        <th style="text-align: left">Prix</th>
                        <th style="text-align: right">Quantité</th>
                        <th style="text-align: right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->getLines() as $line)
                        <tr>
                            <td class="service">{{$line['product']['name']}}</td>
                            <td class="unit">{{$line['product']['price']}}</td>
                            <td class="qty">{{$line['quantity']}}</td>
                            <td class="total">{{$line['product']['price'] * $line['quantity']}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">Total produit</td>
                        <td class="total">{{ $order->getTotal() }}€</td>
                    </tr>
                    <tr>
                        <td colspan="3">Livraison</td>
                        <td class="total">{{ $order->delivery_price }}€</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="grand total">Total</td>
                        <td class="grand total">{{ $order->getTotalWithDelivery() }}€</td>
                    </tr>
                </tbody>
            </table>
        </main>
    </body>
</html>
