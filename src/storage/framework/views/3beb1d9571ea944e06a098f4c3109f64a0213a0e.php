<?php if($result['products']['success']==1): ?>
	<?php $__currentLoopData = $result['products']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="col-12 col-sm-12 col-md-6 col-lg-4">
 		 <!-- Product -->
 		 <div class="product">
 			 <article>
 				 <div class="thumb">
 						 <div class="icons mobile-icons d-lg-none d-xl-none">
 							 <div class="icon-liked">
 								 <a class="icon active is_liked" products_id="<?=$products->products_id?>">
 									 <i class="fas fa-heart"></i>
 									 <span  class="badge badge-secondary counter"  ><?php echo e($products->products_liked); ?></span>
 								 </a>
 							 </div>
 							 <div class="icon modal_show" data-toggle="modal" data-target="#myModal" products_id="<?php echo e($products->products_id); ?>"><i class="fas fa-eye"></i></div>
 								 <a onclick="myFunction3(<?php echo e($products->products_id); ?>)"class="icon"><i class="fas fa-align-right" data-fa-transform="rotate-90"></i></a>
 							 </div>
 					 <img class="img-fluid" src="<?php echo e(asset('').$products->image_path); ?>" alt="<?php echo e($products->products_name); ?>">
 				 </div>
 				 <?php echo $__env->make('web.common.scripts.addToCompare', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 				 <?php
 						$default_currency = DB::table('currencies')->where('is_default',1)->first();
 						if($default_currency->id == Session::get('currency_id')){
 							if(!empty($products->discount_price)){
 							$discount_price = $products->discount_price;
 							}
 							$orignal_price = $products->products_price;
 						}else{
 							$session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
 							if(!empty($products->discount_price)){
 								$discount_price = $products->discount_price * $session_currency->value;
 							}
 							$orignal_price = $products->products_price * $session_currency->value;
 						}
 						 if(!empty($products->discount_price)){

 							if(($orignal_price+0)>0){
 						 $discounted_price = $orignal_price-$discount_price;
 						 $discount_percentage = $discounted_price/$orignal_price*100;
 						 }else{
 							 $discount_percentage = 0;
 							 $discounted_price = 0;
 					 }
 				 ?>
 				 <span class="discount-tag"><?php echo (int)$discount_percentage; ?>%</span>
 				<?php }
 				$current_date = date("Y-m-d", strtotime("now"));

 				$string = substr($products->products_date_added, 0, strpos($products->products_date_added, ' '));
 				$date=date_create($string);
 				date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));

 				//echo $top_seller->products_date_added . "<br>";
 				$after_date = date_format($date,"Y-m-d");

 				if($after_date>=$current_date){
 					print '<span class="discount-tag">';
 					print __('website.New');
 					print '</span>';
 				}
 				 ?>
 				 <span class="tag">
 					 <?php $__currentLoopData = $products->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 							 <?php echo e($category->categories_name); ?><?php if(++$key === count($products->categories)): ?> <?php else: ?>, <?php endif; ?>
 					 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 				 </span>
 				 <h2 class="title text-center"><a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo e($products->products_name); ?></a></h2>
 				 <p class="discription"><?php echo e($products->products_description); ?></p>

 				 <div class="price">
 					 <?php if(!empty($products->discount_price)): ?>
 					 <?php echo e(Session::get('symbol_left')); ?><?php echo e($discount_price+0); ?><?php echo e(Session::get('symbol_right')); ?>

 					 <span> <?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?></span>
 					 <?php else: ?>
 					 <?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?>

 					 <?php endif; ?>
 					 <div class="buttons listview-btn">
 						 <?php if($products->products_type==0): ?>
 								<?php if(!in_array($products->products_id,$result['cartArray'])): ?>
 										<?php if($products->defaultStock==0): ?>

 												<button type="button" class="btn btn-block btn-danger" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->getFromJson('website.Out of Stock'); ?></button>
 										<?php elseif($products->products_min_order>1): ?>
 										 <a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->getFromJson('website.View Detail'); ?></a>
 										<?php else: ?>
 												<button type="button" class="btn btn-block btn-secondary cart" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->getFromJson('website.Add to Cart'); ?></button>
 										<?php endif; ?>
 								<?php else: ?>
 										<button type="button" class="btn btn-block btn-secondary active"><?php echo app('translator')->getFromJson('website.Added'); ?></button>
 								<?php endif; ?>
 						<?php elseif($products->products_type==1): ?>
 								<a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->getFromJson('website.View Detail'); ?></a>
 						<?php elseif($products->products_type==2): ?>
 								<a href="<?php echo e($products->products_url); ?>" target="_blank" class="btn btn-block btn-secondary"><?php echo app('translator')->getFromJson('website.External Link'); ?></a>
 						<?php endif; ?>
 					 </div>
 				 </div>
 				 <div class="product-hover d-none d-lg-block d-xl-block">
 						 <div class="icons">
 							 <div class="icon-liked">
 								 <a class="icon active is_liked" products_id="<?=$products->products_id?>">
 									 <i class="fas fa-heart"></i>
 									 <span  class="badge badge-secondary counter"  ><?php echo e($products->products_liked); ?></span>
 								 </a>
 							 </div>
 							 <div class="icon modal_show" data-toggle="modal" data-target="#myModal" products_id="<?php echo e($products->products_id); ?>"><i class="fas fa-eye"></i></div>
 								 <a onclick="myFunction3(<?php echo e($products->products_id); ?>)"class="icon"><i class="fas fa-align-right" data-fa-transform="rotate-90"></i></a>
 							 </div>
 					 <div class="buttons">
 						 <?php if($products->products_type==0): ?>
 								<?php if(!in_array($products->products_id,$result['cartArray'])): ?>
 										<?php if($products->defaultStock==0): ?>

 												<button type="button" class="btn btn-block btn-danger" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->getFromJson('website.Out of Stock'); ?></button>
 										<?php elseif($products->products_min_order>1): ?>
 										 <a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->getFromJson('website.View Detail'); ?></a>
 										<?php else: ?>
 												<button type="button" class="btn btn-block btn-secondary cart" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->getFromJson('website.Add to Cart'); ?></button>
 										<?php endif; ?>
 								<?php else: ?>
 										<button type="button" class="btn btn-block btn-secondary active"><?php echo app('translator')->getFromJson('website.Added'); ?></button>
 								<?php endif; ?>
 						<?php elseif($products->products_type==1): ?>
 								<a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->getFromJson('website.View Detail'); ?></a>
 						<?php elseif($products->products_type==2): ?>
 								<a href="<?php echo e($products->products_url); ?>" target="_blank" class="btn btn-block btn-secondary"><?php echo app('translator')->getFromJson('website.External Link'); ?></a>
 						<?php endif; ?>
 					 </div>
 				 </div>
 				 <div class="mobile-buttons d-lg-none d-xl-none">
 					 <?php if($products->products_type==0): ?>
 							<?php if(!in_array($products->products_id,$result['cartArray'])): ?>
 									<?php if($products->defaultStock==0): ?>
 											<button type="button" class="btn btn-block btn-danger" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->getFromJson('website.Out of Stock'); ?></button>
 									<?php elseif($products->products_min_order>1): ?>
 									 <a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->getFromJson('website.View Detail'); ?></a>
 									<?php else: ?>
 											<button type="button" class="btn btn-block btn-secondary cart" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->getFromJson('website.Add to Cart'); ?></button>
 									<?php endif; ?>
 							<?php else: ?>
 									<button type="button" class="btn btn-block btn-secondary active"><?php echo app('translator')->getFromJson('website.Added'); ?></button>
 							<?php endif; ?>
 					<?php elseif($products->products_type==1): ?>
 							<a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->getFromJson('website.View Detail'); ?></a>
 					<?php elseif($products->products_type==2): ?>
 							<a href="<?php echo e($products->products_url); ?>" target="_blank" class="btn btn-block btn-secondary"><?php echo app('translator')->getFromJson('website.External Link'); ?></a>
 					<?php endif; ?>
 					 </div>
 			 </article>

 		 </div>
  </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <input id="filter_total_record" type="hidden" value="<?php echo e($result['products']['total_record']); ?>">

    <?php if(count($result['products']['product_data'])> 0 and $result['limit'] > $result['products']['total_record']): ?>
		<style>
			#load_products{
				display: none;
			}
			#loaded_content{
				display: block !important;
			}
			#loaded_content_empty{
				display: none !important;
			}
        </style>
    <?php endif; ?>
    <?php elseif(count($result['products']['product_data'])==0 or $result['products']['success']==0): ?>
		<style>
            #load_products{
                display: none;
            }
            #loaded_content{
                display: none !important;
            }
            #loaded_content_empty{
                display: block !important;
            }
        </style>
    <?php endif; ?>
<?php /**PATH /home/farm2homebd/public_html/src/resources/views/web/filterproducts.blade.php ENDPATH**/ ?>