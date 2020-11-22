<?php
    require 'frontend_header.php';
?>

    <!-- Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  		<ol class="carousel-indicators">
    		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  		</ol>
  		
  		<div class="carousel-inner">
    		<div class="carousel-item active">
		      	<img src="frontend/image/banner/ac.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
		    <div class="carousel-item">
		      	<img src="frontend/image/banner/giordano.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
		    <div class="carousel-item">
		      	<img src="frontend/image/banner/garnier.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
  		</div>
	</div>


	<!-- Content -->
	<div class="container mt-5 px-5">
		<!-- Category -->
		<div class="row">
            <?php
                $sql = "SELECT * FROM categories ORDER BY rand() limit 8";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
				$categories = $stmt->fetchAll();
                foreach($categories as $category){
                    $cid = $category['id'];
                    $cname = $category['name'];
					$cphoto = $category['logo'];
            ?>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 ">
				<!-- <a href="subcategory.php?id='<?= $cid; ?>'" class="text-decoration-none"> -->
					<div class="card categoryCard border-0 shadow-sm p-3 mb-5 rounded text-center">
						<img src="<?= $cphoto; ?>" class="card-img-top" alt="...">
						<div class="card-body">
							<p class="card-text font-weight-bold text-truncate"><?= $cname; ?></p>
						</div>
					</div>
				<!-- </a> -->
            </div>
            <?php } ?>
		</div>

		<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>
		
		<!-- Discount Item -->
		<div class="row mt-5">
			<h1> Discount Item </h1>
		</div>

	    <!-- Disocunt Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">
                        <?php
                            $sql = "SELECT * FROM items WHERE discount != '' ORDER BY rand() limit 8";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $d_items = $stmt->fetchAll();
                            foreach($d_items as $d_item){
                                $d_id = $d_item['id'];
                                $d_name = $d_item['name'];
                                $d_photo = $d_item['photo'];
                                $d_price = $d_item['price'];
                                $d_discount = $d_item['discount'];
						?>
						<div class="item">
							<div class="pad15">
								<a href="item_detail.php?id='<?= $d_id; ?>'" class="text-decoration-none">
									<img src="<?= $d_photo; ?>" class="img-fluid">
									<p class="text-truncate"><?= $d_name; ?></p>
									<p class="item-price">
										<strike><?= $d_price; ?> Ks </strike> 
										<span class="d-block"><?= $d_discount; ?> Ks</span>
									</p>
									<div class="star-rating">
										<ul class="list-inline">
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
										</ul>
									</div>
								</a>
								<!-- <a href="#" class="addtocartBtn text-decoration-none atc">Add to Cart</a> -->
								<button type="submit" class="btn btn-outline-info btn-sm AddtoCart" 
								data-id="<?= $d_id; ?>" data-name="<?= $d_name; ?>" data-photo="<?= $d_photo; ?>" 
								data-price="<?= $d_price; ?>" data-discount="<?= $d_discount; ?>">Add to Cart</button>
							</div>
						</div>
                        <?php } ?>		                
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		<!-- Flash Sale Item -->
		<div class="row mt-5">
			<h1> Flash Sale </h1>
		</div>

	    <!-- Flash Sale Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">
                        <?php
                            $sql = "SELECT * FROM items ORDER BY created_at DESC";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $f_items = $stmt->fetchAll();
                            foreach($f_items as $f_item){
                                $f_id = $f_item['id'];
                                $f_name = $f_item['name'];
                                $f_photo = $f_item['photo'];
                                $f_price = $f_item['price'];
                                $f_discount = $f_item['discount'];
						?>
						<div class="item">
							<div class="pad15">
								<a href="item_detail.php?id='<?= $f_id; ?>'" class="text-decoration-none">
									<img src="<?= $f_photo; ?>" class="img-fluid">
									<p class="text-truncate"><?= $f_name; ?></p>
									<p class="item-price">
										<?php
											if($f_discount){
												?>
												<strike><?= $f_price; ?> Ks </strike> 
												<span class="d-block"><?= $f_discount; ?> Ks</span>
												<?php
											}else{
												?>
												<span class="d-block"><?= $f_price; ?> Ks</span>
												<?php
											}
										?>
									</p>
									<div class="star-rating">
										<ul class="list-inline">
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
										</ul>
									</div>
								</a>
								<!-- <a href="#" class="addtocartBtn text-decoration-none atc">Add to Cart</a> -->
								<button type="submit" class="btn btn-outline-info btn-sm AddtoCart" 
								data-id="<?= $f_id; ?>" data-name="<?= $f_name; ?>" data-photo="<?= $f_photo; ?>" 
								data-price="<?= $f_price; ?>" data-discount="<?= $f_discount; ?>">Add to Cart</button>
							</div>
						</div>
                        <?php } ?>	                
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		<!-- Random Catgory ~ Item -->
		<div class="row mt-5">
			<h1> Fresh Picks </h1>
		</div>

	    <!-- Random Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">
                        <?php
                            $sql = "SELECT * FROM items ORDER BY created_at";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $fr_items = $stmt->fetchAll();
                            foreach($fr_items as $fr_item){
                                $fr_id = $fr_item['id'];
                                $fr_name = $fr_item['name'];
                                $fr_photo = $fr_item['photo'];
                                $fr_price = $fr_item['price'];
                                $fr_discount = $fr_item['discount'];
						?>
						<div class="item">
							<div class="pad15">
								<a href="item_detail.php?id='<?= $fr_id; ?>'" class="text-decoration-none">
									<img src="<?= $fr_photo; ?>" class="img-fluid">
									<p class="text-truncate"><?= $fr_name; ?></p>
									<p class="item-price">
										<?php
											if($fr_discount){
												?>
												<strike><?= $fr_price; ?> Ks </strike> 
												<span class="d-block"><?= $fr_discount; ?> Ks</span>
												<?php
											}else{
												?>
												<span class="d-block"><?= $fr_price; ?> Ks</span>
												<?php
											}
										?>
									</p>
									<div class="star-rating">
										<ul class="list-inline">
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
										</ul>
									</div>
								</a>
								<!-- <a href="#" class="addtocartBtn text-decoration-none atc">Add to Cart</a> -->
								<button type="submit" class="btn btn-outline-info btn-sm AddtoCart" 
								data-id="<?= $fr_id; ?>" data-name="<?= $fr_name; ?>" data-photo="<?= $fr_photo; ?>" 
								data-price="<?= $fr_price; ?>" data-discount="<?= $fr_discount; ?>">Add to Cart</button>
							</div>
						</div>
                        <?php } ?>		                
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		
		<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>

	    <!-- Brand Store -->
	    <div class="row mt-5">
			<h1> Top Brand Stores </h1>
	    </div>

	    <!-- Brand Store Item -->
	    <section class="customer-logos slider mt-5">
            <?php
                $sql = "SELECT * FROM brands";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $d_brands = $stmt->fetchAll();
                foreach($d_brands as $d_brand){
                    $db_id = $d_brand['id'];
                    $db_name = $d_brand['name'];
                    $db_photo = $d_brand['photo'];
            ?>
	      	<div class="slide">
	      		<a href="">
		      		<img src="<?= $db_photo; ?>" class="img-fluid">
		      	</a>
            </div>
            <?php } ?>
	   	</section>

	    <div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>

    </div>
    
<?php
    require 'frontend_footer.php';
?>