@foreach ($options as $keyOption=> $option)
<?php $last = '' ;?>
@if ($loop->last)
    <?php $last = '_last'; ?>
@endif
<h3 class="m-portlet__head-text pr-3">
    <span>{{ $option->option_name }}  {{ $option->id }}</span>
</h3>


            
@if($option->children->count())
    @include('frontend.products.forms.options' , ['options' => $option->children])
@endif
@endforeach

