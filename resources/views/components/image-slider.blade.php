
@push('styles')
    <style>
        .product-image{
            width: 80px;
            border: 3px dashed black;
            border-radius: 10px;
        }
        .product-image:hover{
            cursor: pointer;
        }
        .image-container{
            z-index: 1;
            border: 3px solid rgb(8, 8, 77);
            border-radius: 25px;
            position: fixed;
            display: flex;
            flex-wrap: wrap;
            width: 45%;
            flex-direction: column;
            top: 10%;
            left: 30%;
            justify-content: center;
            align-items: center;
            background: white;
        }
        .image-container .main-image{
            width: 60%;
            border-radius: 25px;
            margin-top: 2%;
        }
        .image-container .sub-image{
            width: 20%;
        }
        .image-container  .sub-image-container{
            display: flex;
            flex-wrap: wrap;
            margin-top: 3%;
        }
        .image-container  .sub-image-container img{
            margin-right: 5%;
            border-radius: 50%;
        }
        .display-none{
            display: none
        }

        .fa-times{
            position: absolute;
            top: 0%;
            right: 5%;
            font-size: 30px;
        }
        .fa-times:hover{
            cursor: pointer;
        }

        .active-border{
            border-color: rgb(141, 19, 19)
        }
        .sub-image:hover{
            cursor: pointer;
        }

        @media screen and (max-width: 820px){
            .image-container{
                left: 15%;
            }
        }
        @media screen and (max-width: 510px){
            .image-container{
                width: 70%;
                top: 20%;
                left: 10%;
            }
        }
    </style>
@endpush

<img  class="product-image" onclick="toggleImages(this)" src="{{ $product->first()['url'] }}">
<div class="image-container display-none">
    <i class="fas fa-times" onclick="closeImageContainer(this)"></i>
    <img src="{{ $product->first()['url'] }}" alt="" class="main-image">
    <div class="sub-image-container">
        @foreach ($product as $img)
            <img src="{{ $img['url'] }}" class="sub-image" onclick="changeImage(this)" alt="">
        @endforeach
    </div>
</div>

@push('scripts')
    <script>
        function toggleImages(event){
            let image_containers = document.querySelectorAll('.image-container');
            image_containers.forEach(container => {
                container.classList.add('display-none')
            });
            event.nextElementSibling.classList.remove('display-none');
        }
        function changeImage(event){
            event.parentElement.previousElementSibling.src = event.src;
        }
        function closeImageContainer(event){
            event.parentElement.classList.add('display-none')
        }
    </script>

@endpush
