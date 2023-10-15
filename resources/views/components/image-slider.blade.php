<img class="product-image" onclick="toggleImages(this)" src="{{ $product->first()['url'] }}">
<div class="image-slider-wrapper display-none">
    <div class="image-container">
        <i class="fas fa-times" onclick="closeImageContainer(this)"></i>
        <img src="{{ $product->first()['url'] }}" alt="" class="main-image">
        <div class="sub-image-container">
            @foreach ($product as $img)
                <img src="{{ $img['url'] }}" class="sub-image" onclick="changeImage(this)" alt="">
            @endforeach
        </div>
    </div>
</div>


@push('scripts')
    <script>
        function toggleImages(event) {
            let image_containers = document.querySelectorAll('.image-slider-wrapper');
            image_containers.forEach(container => {
                container.classList.add('display-none')
            });
            event.nextElementSibling.classList.remove('display-none');
        }

        function changeImage(event) {
            event.parentElement.previousElementSibling.src = event.src;
        }

        function closeImageContainer(event) {
            event.parentElement.parentElement.classList.add('display-none')
        }
    </script>
@endpush
