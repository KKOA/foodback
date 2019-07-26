<?php 

$features = [
    1=>'Reservations',
    2=>'Delivery',
    3=>'Take Away',
    4=>'On-Site Parking',
    5=>'Wi-Fi',
    6=>'Wheelchair Accessible',
    7=>'Full Bar',
    8=>'Indoor Seating',
    9=>'OutDoor Seating'
];

$serverTimes =
[
    1=>'All Day',
    2=>'Morning',
    3=>'Lunch',
    4=>'Evening',
];


$myCount = 1;

?>

<div class="row justify-content-center text-center">
    <div class="col-12 mr-1 col-md-10">
        <button id="sidebar-main-trigger" class="mt-2 mb-2 btn btn-secondary" title="Show filters">
                Show Filters 
        </button>
        <button class="mt-2 mb-2  ml-1 btn btn-secondary current-filter-btn show-current-filter" title="Show selected filters"> 
            Active Filters 
        </button>
    </div>
</div>
    
<div class="row active-filters-wrapper justify-content-center text-center">
    <div class="col-12 offset-md-1 col-md-10 my-card active-filters-card pb-3">
        <header class='card-header bg-blue-header remove-bs-padding'><h3>Active Filters</h3></header>
        <div class="mt-2 mb-2">
            <p class="mb-1 pl-1 pr-1">Click a filter to remove it or remove all filters with 'Clear all filters' button.</p>
            <button  class="mr-1 btn btn-secondary clear-active-filters" title="Remove all current filters">
                Clear all filters
            </button>
        </div>
        <div class="row mb-2 remove-bs-padding">

            <div class="col-12 col-md-3 col-lg-2  pt-2 pr-0 pl-0 text-md-right">
                <span class="font-weight-bold mt-1 mb-1 active-filter-type-header">Feature:</span>
            </div>
            <div class="col-12 col-md-9 col-lg-10 col-xl-4 text-md-left pl-2 pr-2" >
                @for(;$myCount <= 7; $myCount++)
                <span class="active-filter">
                    <a href="#">{{$features[$myCount]}} <i class="fas fa-times-circle"></i></a>
                </span>
                @endfor
            </div>
            <div class="col-md-3 col-lg-2  pt-2 pr-0 pl-0 text-md-right">
                <span class="font-weight-bold mt-1 mb-1 active-filter-type-header">Serving time:</span>
            </div>
            <div class="col-md-9 col-lg-10 col-xl-4 text-md-left  pl-2 pr-2" >
                <span class="active-filter">
                    <a href="#">All Day <i class="fas fa-times-circle"></i></a>
                </span>
            </div>
        </div>
    </diV>
</div>
    
<div id="sidebar-main" class="sidebar main right myfilter" >
    <header class="bg-blue-header">
        <h2>Filter</h2>
        <button class="close rounded-circle quitter" title="Hide filters menu">
            <i class="fas fa-times"></i>
        </button>
    </header>
    <div class="wrapper">
        
        {{-- Cusines --}}
        <p class="filter-title font-weight-bold cuisine-filter-header">
            <a href="#">Cuisines</a>
        </p>                
        <ul class="cuisine-filter filter-options d-none"> 
            @foreach($cuisines as $cuisine)
                <?php 
                $qtyOfItem = rand(0,count($restaurants));
                ?>
                @if($qtyOfItem > 0)    
                <li>
                <label class='my-checkbox-label' id='{{$cuisine->name}}' class='text-center'>
                    {{Form::checkbox('cuisines[]', $cuisine->id , null)}}   
                    <span class="label-text">{{ $cuisine->name}}</span><span>({{$qtyOfItem}})</span>
                </label>
                </li>
                @endif
            @endforeach
        </ul>
        {{-- Features --}}
        <p class="filter-title font-weight-bold">
            <a href="#">Features</a>
        </p>
        <ul class="cuisine-filter filter-options d-none"> 
            @foreach($features as $key => $value) 
                <?php 
                $qtyOfItem = rand(0,count($restaurants));
                ?>
                @if($qtyOfItem > 0)   
                <li>
                <label class='my-checkbox-label' id='{{$value}}' class='text-center'>
                    {{Form::checkbox('feautures[]', $key , null)}}   
                    <span class="label-text">{{ $value}}</span><span>({{$qtyOfItem}})</span>
                </label>
                </li>
                @endif
            @endforeach
        </ul>
        {{-- Serving Times --}}
        <p class="filter-title font-weight-bold">
            <a href="#">Serving Times</a>
        </p>
        <ul class="cuisine-filter filter-options d-none"> 
            @foreach($serverTimes as $key => $value)    
                <?php 
                $qtyOfItem = rand(0,count($restaurants));
                ?>
                @if($qtyOfItem > 0)
                <li>
                <label class='my-checkbox-label' id='{{$value}}' class='text-center'>
                    {{Form::checkbox('serverTimes[]', $key , null)}}   
                    <span class="label-text">{{ $value}}</span><span>({{$qtyOfItem}})</span>
                </label>
                </li>
                @endif
            @endforeach
        </ul>

        <p class="mt-5">
            <a href="#">Clear all filters</a>
        </p>
    </div>
</div>
{{--#sidebar-main--}}