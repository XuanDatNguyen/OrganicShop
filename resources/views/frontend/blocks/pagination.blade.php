<div class="aa-product-catg-pagination">
  <nav>
    <ul class="pagination">
    @if ($product->currentPage() != 1)
      <li>
        <a href="{!! str_replace('/?','?',$product->url($product->currentPage() - 1)) !!}" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
    @endif
    @for ($i = 1; $i <=  $product->lastPage(); $i++)
      <li class="{!! ($product->currentPage() == $i)? 'active':'' !!}"><a href="{!! str_replace('/?','?',$product->url($i)) !!}">{!! $i !!}</a></li>
    @endfor
    @if ($product->currentPage() != $product->lastPage())
      <li>
        <a href="{!! str_replace('/?','?',$product->url($product->currentPage() + 1)) !!}" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    @endif
      
    </ul>
  </nav>
</div>