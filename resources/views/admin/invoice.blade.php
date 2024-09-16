<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    body {
        font-family: 'DejaVu Sans', sans-serif;
        color: #000;
        margin: 0;
        padding: 20px;
        background-color: #fff;
    }

    .container {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    h1 {
        font-size: 26px;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
        border-bottom: 2px solid #000;
        padding-bottom: 5px;
        text-align: center;
    }

    h2 {
        font-size: 20px;
        margin-bottom: 5px;
        font-weight: normal;
        text-align: left;
    }

    p {
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 10px;
    }

    .info {
        width: 100%;
        margin-bottom: 20px;
        text-align: left;
        border-bottom: 1px solid #000;
        padding-bottom: 10px;
    }

    .info p {
        margin: 5px 0;
    }

    .header-p {
    font-size: 30px;
    margin: 20px;
    text-align: center;
}

    .product-info {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 0;
        border-bottom: 2px solid #000;
    }

    .product-details {
        max-width: 50%;
    }

    .product-details p {
        margin: 5px 0;
        font-weight: normal;
    }

    .product-image {
        max-width: 45%;
    }

    .product-image img {
        width: 100%;
        border: 1px solid #000;
        padding: 5px;
        align-items: center;
        justify-content: center;
    }

    .footer {
        margin-top: 20px;
        font-size: 12px;
        color: #666;
        text-align: center;
        border-top: 1px solid #000;
        padding-top: 10px;
    }
    </style>
</head>
<body>

    <div class="container">
        <p class="header-p"><strong>შეკვეთის ინფორმაცია</strong></p>

        <div class="info">
            <p><strong>მომხმარებლის სახელი:</strong> {{$data->name}}</p>
            <p><strong>მომხმარებლის მისამართი:</strong> {{$data->rec_address}}</p>
            <p><strong>მომხმარებლის ტელეფონის ნომერი:</strong> {{$data->phone}}</p>
        </div>
        <div class="product-info">
            <div class="product-details">
                <p><strong>პროდუქტის დასახელება: </strong>{{$data->product->title}}</p>
                <p><strong>პროდუქტის ფასი: </strong> {{$data->product->price}} ლარი</p>
            </div>
            <div class="product-image">
                <img src="products/{{$data->product->image}}" alt="Product Image">
            </div>
        </div>
        <div class="footer">
            <p>Abstrage</p>
        </div>
    </div>

</body>
</html>
