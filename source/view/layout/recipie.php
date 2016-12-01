<a href="/recipie/item/{{ $res->id }}">
    <div class="recipie-preview" style="background-image: url('{{ $res->thumbnail }}');"></div>
    <span class="star-rating-fixed">
      <span class="stars-{{ (int) $res->rating }}"></span>
    </span>
    <div class="recipie-text center">{{ $res->name }}</div>
</a>
