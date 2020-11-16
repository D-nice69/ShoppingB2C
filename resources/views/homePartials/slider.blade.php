<section id="slider">
    <!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($sliders as $key => $slider)
                        <li data-target="#slider-carousel" data-slide-to="{{ $key }}"
                            class="{{ ($key == 0) ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($sliders as $key => $slider)
                        <div class="item {{ ($key == 0) ? 'active' : '' }}">
                            {{-- <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>{{ $slider->name }}</h2>
                                <p>{{ $slider->desc }}</p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div> --}}
                            <div class="col-sm-12">
                                <img style="object-fit: cover;
                               height:300px" src="/uploads/sliders/{{ $slider->image }}" class="girl img-responsive"
                                    alt="{{ $slider->desc }}" width="100%"/>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" style="top: 40%;" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" style="top: 40%;" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>