<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #e2e2e2;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #444;
            border-radius: 4px;
            background: #555;
            color: #fff;
        }

        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            display: inline-block;
            padding: 10px 20px;
            cursor: pointer;
            background: #007bff;
            color: white;
            border-radius: 4px;
            text-align: center;
            margin-top: 10px;
            transition: background 0.3s ease;
        }

        .custom-file-upload:hover {
            background: #0056b3;
        }

        .image-preview {
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
            gap: 10px;
        }

        .image-container {
            position: relative;
        }

        .image-container img {
            width: 150px;
            height: auto;
            border: 2px solid #007bff;
            border-radius: 4px;
            object-fit: cover;
        }

        .remove-image {
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 25px;
            position: absolute;
            top: 0;
            right: 0;
            transition: background-color 0.3s ease;
        }

        .remove-image:hover {
            background-color: #c82333;
        }

        .btn-submit {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #218838;
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            .image-container img {
                width: 100px;
            }

            .custom-file-upload {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container">
            <h1>პროდუქციის რედაქტირება</h1>
            <form action="{{ url('edit_product', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>კოდი</label>
                    <input type="text" name="code" value="{{ $data->code }}" required>
                </div>

                <div class="form-group">
                    <label>სათაური</label>
                    <input type="text" name="title" value="{{ $data->title }}" required>
                </div>

                <div class="form-group">
                    <label>აღწერა</label>
                    <textarea name="description" required>{{ $data->description }}</textarea>
                </div>

                <div class="form-group">
                    <label>ფასი</label>
                    <input type="text" name="price" value="{{ $data->price }}" required>
                </div>

                <div class="form-group">
                    <label>რაოდენობა</label>
                    <input type="text" name="qty" value="{{ $data->quantity }}" required>
                </div>

                <div class="form-group">
                    <label>კატეგორია</label>
                    <select name="category" required>
                        <option value="{{ $data->category }}">{{ $data->category }}</option>
                        @foreach ($category as $category)
                            <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>მიმდინარე ფოტოები</label>
                    <div class="image-preview">
                        @foreach ($data->images as $image)
                            <div class="image-container" id="image-{{ $image->id }}">
                                <img src="/products/{{ $image->image }}" alt="image">
                                <button type="button" class="remove-image" onclick="removeImage('{{ $image->id }}')">X</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label>ახალი ფოტოები</label>
                    <label class="custom-file-upload">
                        <input type="file" name="images[]" accept="image/*" multiple onchange="previewImages(event)" />
                        ატვირთეთ ახალი ფოტოები
                    </label>
                    <div class="image-preview" id="new-images-preview"></div>
                </div>

                <div class="form-group">
                    <input class="btn-submit" type="submit" value="რედაქტირება">
                </div>
            </form>
        </div>
    </div>

    @include('admin.js')

    <script>
        function removeImage(imageId) {
            if (confirm("დარწმუნებული ხარ რომ ამ ფაილის წაშლა გინდა?")) {
                fetch(`/remove_image/${imageId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => {
                        if (response.ok) {
                            document.getElementById(`image-${imageId}`).remove();
                        } else {
                            alert("ფოტო არ წაიშალა.");
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }

        function previewImages(event) {
            const newImagesPreview = document.getElementById('new-images-preview');
            newImagesPreview.innerHTML = '';
            const files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = "New Image";
                    img.width = 150;
                    img.style.border = '2px solid #007bff';
                    img.style.borderRadius = '4px';
                    img.style.marginRight = '10px';
                    newImagesPreview.appendChild(img);
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>
