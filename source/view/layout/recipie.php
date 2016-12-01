<a href="/recipie/item/{{ $res->id }}">
    <div class="recipie-preview" style="background-image: url('{{ $res->thumbnail }}');"></div>
    <span class="star-rating star-rating--small">
        <input type="radio" name="rating" value="1" disabled><i></i>
        <input type="radio" name="rating" value="2" disabled><i></i>
        <input type="radio" name="rating" value="3" disabled><i></i>
        <input type="radio" name="rating" value="4" disabled><i></i>
        <input type="radio" name="rating" value="5" disabled><i></i>
    </span>
    <script>
      document.querySelector('[name=rating]:nth-of-type({{ (int) $res->rating }})').setAttribute('checked', 'checked');
    </script>
    <div class="recipie-text center">{{ $res->name }}</div>
</a>
