<!-- Cart-drop -->
    <div class="add-to-cart">
        <!-- Sub-cart -->
        <div class="sub-cart">
            <div class="cart-inner">
               <div class="pro-add">
               @if(session('cart'))
                  @foreach (session('cart')->items as $item)
                      <div class="row-cart">
                       <div class="img-cart">
                          <img src="{{ voyager::image($item['image'])}}" />
                       </div>
                       <div class="details-cart">
                           <a href="#">{{$item['title']}}({{ $item['quantity']}})</a>
                       </div>
                       <div class="price-cart">
                           <span>{{$item['price']}} @lang('site.reyal')</span>
                            <form action="{{ route('removeFromCart' , $item['id'])}}" method="post">
                              @csrf
                              @method('delete')
                               <button type="submit" class="btn-remove"><i class="fa fa-times">@lang('site.remove')</i></button>
                            </form>
                       </div>
                   </div>
                  @endforeach 
                  </div> 
                <!-- Total -->
                <div class="total-cart">
                    <ul>
                        <li>
                            <strong>@lang('site.total')</strong>
                        </li>
                        <li>
                            <strong>
                              {{session()->has('cart') ? session()->get('cart')->totalPrice : '0'}} @lang('site.reyal')
                           </strong>                            
                        </li>
                    </ul>
                </div>

                
                
                <!-- Btns -->
                <div class="btn-group">
                    <a href="{{ route('cartProducts') }}" class="btn"><span>@lang('site.complete_order')</span></a>
                </div>
                @else
                  <div class="alert alert-danger">
                     <p>@lang('site.empty')</p>
                  </div>
                @endif
            </div>
        </div>
        <!-- Btn -->
        <a class="btn-cart"><i class="fal fa-shopping-basket"></i> 
         <span class="gin-total">
            {{session()->has('cart') ? session()->get('cart')->totalQuantity : '0'}}
         </span></a>
    </div>
    <!-- End Cart-drop -->