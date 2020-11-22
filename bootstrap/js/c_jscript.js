$(document).ready(function(){
    showdata();
	count();

    $(".AddtoCart").click(function(){
        var id = $(this).data('id');
        var name = $(this).data('name');
        var photo = $(this).data('photo');
        var price = $(this).data('price');
        var discount = $(this).data('discount');
        
        var item = {
            id:id,
            name:name,
            photo:photo,
            price:price,
            discount:discount,
            qty:1
        }
        var itemlist = localStorage.getItem("additems");
        var itemArray;
        if(itemlist == null){
            itemArray = [];
        }else{
            itemArray = JSON.parse(itemlist);
        }
        var status = false;
        $.each(itemArray,function(i,v){
            if(v.id == id){
                v.qty++;
                status = true;
            }
        })
        if(!status){
            itemArray.push(item);
        }
        var itemString = JSON.stringify(itemArray);
        localStorage.setItem("additems", itemString);
        showdata();
        count();
    });
    function showdata(){
		var itemlist = localStorage.getItem("additems");
		if (itemlist) {
			$('.shoppingcart_div').show();
			$('.noneshoppingcart_div').hide();
			var itemArray = JSON.parse(itemlist);
			var shoppingcartData='';
			if (itemArray.length > 0) {
				var total = 0;
				$.each(itemArray, function(i,v){
					var id = v.id;
					var name = v.name;
					var unitprice = v.price;
					var discount = v.discount;
					var photo = v.photo;
					var qty = v.qty;

					if (discount) {
						var price = discount;
					}
					else{
						var price = unitprice;
					}
					var subtotal = price * qty;

					shoppingcartData += `<tr> 
											<td> 
												<button class="btn btn-outline-danger remove btn-sm" data-id="${i}" style="border-radius: 50%"> 
													<i class="icofont-close-line"></i> 
												</button>
											</td>
											<td><img src="${photo}" class="cartImg"></td>
											<td><p> ${name} </p></td>
											<td>
												<button class="btn btn-outline-secondary btnincrease" data-id="${i}"> 
													<i class="icofont-plus"></i> 
												</button>
											</td>
											<td><p> ${qty} </p></td>
											<td>
												<button class="btn btn-outline-secondary btndecrease" data-id="${i}"> 
													<i class="icofont-minus"></i>
												</button>
											</td>
											<td>`; 
					if (discount > 0) {
						shoppingcartData += `<p class="text-danger">${discount} Ks</p>
											<p class="font-weight-lighter"><del> ${unitprice} Ks </del></p>`;
					}
					else{
						shoppingcartData += `<p class="text-danger">${unitprice} Ks</p>`;
					}
					shoppingcartData+=`</td>
										<td><p> ${subtotal} Ks </p></td></tr>`;
					total += subtotal ++;
				});
				$('#shoppingcart_table').html(shoppingcartData);
			}
			else{
				$('.shoppingcart_div').hide();
				$('.noneshoppingcart_div').show();
			}
		}
		else{
			$('.shoppingcart_div').hide();
			$('.noneshoppingcart_div').show();
		}
	};
    $("tbody#shoppingcart_table").on("click",".remove",function(){
        var id=$(this).data("id");
        var itemlist=localStorage.getItem("additems");
        var ItemArray=JSON.parse(itemlist);
        ItemArray.splice(id,1);
        var itemstring=JSON.stringify(ItemArray);
        localStorage.setItem("additems", itemstring);
        showdata();
        count();
    });
    function count(){
		var itemlist = localStorage.getItem("additems");
		if (itemlist) {
			var itemArray = JSON.parse(itemlist);
			var totalcount =0;
			var noti = 0;
			$.each(itemArray, function(i,v){

				var unitprice = v.price;
				var discount = v.discount;
				var qty = v.qty;
				if (discount) {
					var price = discount;
				}
				else{
					var price = unitprice;
				}
				var subtotal = price * qty;

				noti += qty ++;
				totalcount += subtotal ++;
			})
			$('.cartNoti').html(noti);
			$('.totalamount').html(totalcount+' Ks');
		}
		else{
			$('.cartNoti').html(0);
			$('.totalamount').html(0+' Ks');
		}
	};
    $("tbody#shoppingcart_table").on("click",".btnincrease",function(){
        var id = $(this).data("id");
        var itemlist = localStorage.getItem("additems");
        var itemArray = JSON.parse(itemlist);
        $.each(itemArray,function(i,v){
            if(i == id){
                v.qty++;
            }
        })
        var stringitem = JSON.stringify(itemArray);
        localStorage.setItem("additems", stringitem);
        showdata();
        count();
    });
    $("tbody#shoppingcart_table").on("click",".btndecrease",function(){
        var id = $(this).data("id");
        var itemlist = localStorage.getItem("additems");
        var itemArray = JSON.parse(itemlist);
        $.each(itemArray,function(i,v){
            if(i == id){
                v.qty--;
                if(v.qty < 1){
                    itemArray.splice(id,1);
                }
            }
        })
        var stringitem = JSON.stringify(itemArray);
        localStorage.setItem("additems", stringitem);
        showdata();
        count();
    });

    $(".checkoutbtn").on('click', function(){
        var notes = $("#notes").val();
        var itemlist = localStorage.getItem("additems");
        var itemArray = JSON.parse(itemlist);
        var totalcount =0;
		$.each(itemArray, function(i,v){
			var unitprice = v.price;
			var discount = v.discount;
			var qty = v.qty;
			if (discount) {
				var price = discount;
			}
			else{
				var price = unitprice;
            }
    		var subtotal = price * qty;
			totalcount += subtotal ++;
        });
        console.log(totalcount);
        $.post('storeorder.php', {
            item: itemArray,
            notes: notes,
            total: totalcount
        }, function(response){
            localStorage.clear();
            location.href="ordersuccess.php";
        })
	});
	/////////////////////////////////////////
	$('.profile_editBtn').show();
	$('.profile_cancelBtn').hide();

	$('.profile_editBtn').on('click', function(){
		$("fieldset").removeAttr("disabled");
		$("#imageUpload").removeAttr("disabled");

		$('.profile_editBtn').hide();
		$('.profile_cancelBtn').show();

	});

	$('.profile_cancelBtn').on('click', function(){
		$('#imageUpload').prop('disabled', true);
		$('fieldset').prop('disabled', true);


		$('.profile_editBtn').show();
		$('.profile_cancelBtn').hide();

	});

	function readURL(input){
        if (input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
            console.log('preivew');
        }
        console.log(input.files);
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });

    $('#inputPassword').change(function ()
    {
        var password=$(this).val();
        console.log(password.length);

        if(password.length > 8)
        {
        	$('#error').html(`<span class="text-danger">* Password shouldn't exceed eight digit</span>`);
        }
    });

    $('#inputConfirmPassword').change(function () 
    {
        var cpassword = $(this).val();
        var password = $("#inputPassword").val();


        if(password!=cpassword)
        {
          	$('#cerror').html(`<span class="text-danger">* Confirm Password don't match!</span>`);
        }
        else{
          	$('#cerror').html();
          	$('#cerror').html(`<span class="text-success">* Confirm Password match!</span>`);

        }
    });
    ///////////////////////////////////////

    $('.orderDetail').click(function(){

		var id = $(this).data('id');
		var orderdate = $(this).data('orderdate');
		var voucherno = $(this).data('voucherno');
		var total = $(this).data('total');
		var status = $(this).data('status');

		console.log(id);		

		$.post('getorderdetail.php',{
			id: id,
		},function(response){
			console.log(response);

      		var orderdetails = JSON.parse(response); 

			var shoppingcartData='';

			shoppingcartData +=`<div>`;

      		$.each(orderdetails,function (i,v) 
			{
				var id = v.id;
				var codeno = v.codeno;
				var name = v.name;
				var unitprice = v.price;
				var discount = v.discount;
				var photo = v.photo;
				var qty = v.qty;

				if (discount) {
					var price = discount;
				}
				else{
					var price = unitprice;
				}
				var subtotal = price * qty;

				shoppingcartData += `<tr> 
										<td> 
											<img src="${photo}" class="cartImg">
										</td>
										<td>
											<p> ${name} </p>
											<p> ${codeno} </p>
										</td>
										<td>
											<p> ${qty} </p>
										</td>
										<td>`; 
				if (discount > 0) {
					shoppingcartData += `<p class="text-danger"> 
											${discount} Ks
										</p>
										<p class="font-weight-lighter">
											<del> ${unitprice} Ks </del>
										</p>
										`;
				}
				else{
					shoppingcartData += `<p class="text-danger"> 
											${unitprice} Ks
										</p>`;
				}

				shoppingcartData+=`</td>
									<td> 
										<p> ${subtotal} Ks </p> 
									</td>
								</tr>`;
				total += subtotal ++;
			});

			$('#orderDetail').html(shoppingcartData);


		});

        $('#invoiceNo').html(voucherno);
        $('#dateNo').html(orderdate);

        if (status == "Order") {
        	statusBadge = '<h5> <span class="badge badge-warning">'+status+'</span> </h5>';
        	$('#orderStatus').html(statusBadge);
        }
        else if (status == "Confirm") {
        	statusBadge = '<h5> <span class="badge badge-success">'+status+'</span> </h5>';
        	$('#orderStatus').html(statusBadge);
        }
        else if (status == "Cancel") {
        	statusBadge = '<h5> <span class="badge badge-danger">'+status+'</span> </h5>';
        	$('#orderStatus').html(statusBadge);
        }
        else{
        	statusBadge = '<h5> <span class="badge badge-primary">'+status+'</span> </h5>';
        	$('#orderStatus').html(statusBadge);
        }
        $('#invoiceTotal').html(total);
        $('#orderTotal').html(total);

        $('#detailModal').modal('show');

	});
});