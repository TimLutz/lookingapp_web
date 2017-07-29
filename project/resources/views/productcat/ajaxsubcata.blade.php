								@if($subcats)
								@foreach($subcats as $subcat)
								<li>
									<input type="checkbox" id="chk{{ $subcat->id }}" name="subcategory[]" value="{{ $subcat->id }}">
									<span class="lable-holder"><label for="chk{{ $subcat->id }}">{{ $subcat->name }}</label></span>
								</li>
								@endforeach
								@endif
						
