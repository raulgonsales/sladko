<div id="slider1_container">

    <!-- Loading Screen -->
    <div data-u="loading" class="jssorl-009-spin">
        <img src="{{ asset('svg/spin.svg') }}" />
    </div>

    <!-- Slides Container -->
    <div data-u="slides" class="slides">
        @foreach($images as $image)
            <div>
                <img data-u="image" src="{{ $image['image'] }}" alt="{{ $image['image_descr'] }}"/>
                <img data-u="thumb" src="{{ $image['thumb'] }}" alt="{{ $image['image_descr'] }}"/>
            </div>
        @endforeach
    </div>

    <!--#region Thumbnail Navigator Skin Begin -->
    <div data-u="thumbnavigator" class="jssort07">
        <!-- Thumbnail Item Skin Begin -->
        <div data-u="slides" style="cursor: default;">
            <div data-u="prototype" class="p">
                <div data-u="thumbnailtemplate" class="i"></div>
                <div class="o"></div>
            </div>
        </div>
        <!-- Thumbnail Item Skin End -->

        <!--#region Arrow Navigator Skin Begin -->
        <div data-u="arrowleft" class="jssora051 left" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora051 right" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
            </svg>
        </div>
        <!--#endregion Arrow Navigator Skin End -->
    </div>
    <!--#endregion Thumbnail Navigator Skin End -->

    <!-- Trigger -->
    <script>
      jssor_slider1_init();
    </script>

</div>
<!-- Jssor Slider End -->