

<div class="wk_quick_order_box">
    <div class="table-responsive">
        	<table class="table table-striped" id="wk_quick_order_product_table">
						<thead>
							<tr>
                                <th scope="col">Image</th>
								<th scope="col">SKU</th>								
								<th scope="col">Product</th>
								<th scope="col">Price</th>
							</tr>
						</thead>
                        
                        
                        <tbody>
                            <tr>
                                <td class="wk_qo_product_img_col">
                                    <?php echo preg_replace('/(<[^>]+) sizes=".*?"/i', '$1', woocommerce_get_product_thumbnail()); ?> 
                                </td>
                                
                                <td class="wk_qo_product_sku">
                                    <p class="mb-0">SKU: <?php echo $product->get_sku(); ?></p>    
                                </td>
                                
                                <td class="wk_qo_product_name_col">
                                    <?php the_title(); ?>
                                    <?php echo $secondary_title ? "<div class='subtitle'>$secondary_title</div>" : ''; ?>
                                </td>                                
                                
                                <td class="wk_qo_product_price">
                                    <?php echo $rrp_html ? "<div class='rrp'>Our Price $rrp_html</div> " : ""; ?>
                                    <?php echo $price_html ? "<div class='our_price'>$price_html_text $price_html</div> " : ""; ?>
                                </td>                                
                            </tr>
                        </tbody>
</table>    



    </div><!-- end table-responsive -->
</div>

