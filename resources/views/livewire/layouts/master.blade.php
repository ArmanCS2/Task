<!DOCTYPE html>
<html lang="en">

<head>
    @include('livewire.layouts.head-tag')
    @yield('head-tag')
</head>

<body dir="rtl">


@include('livewire.layouts.header')

<section class="body-container">
    @include('livewire.layouts.sidebar')
    <section id="main-body" class="main-body">
        @yield('content')
    </section>
</section>


@include('livewire.layouts.scripts')
@yield('scripts')
<section class="toast-wrapper flex-row-reverse d-none">

</section>
</body>

</html>
