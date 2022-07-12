<?php

@component('mail::message')

@if (count($accommodaionUnits) > 1)
    @foreach ($accommodaionUnits as $accommodaionUnit)
        <p>Назва: {{$accommodaionUnit->title}}</p>
    @endforeach
@else
    <p>Назва: {{$accommodaionUnits->title}}</p>
@endif
    <p>Сума разом: {{$totalPrice}}</p>
    <p>Очікуйте повідомлення про підтвердження бронювання</p>

<p>Дякуємо, що скористалися нашими послугами</p>
@endcomponent


