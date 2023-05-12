<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Product Inventory</title>
	<!-- Load Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="container mt-5">
		<h1>Product Inventory</h1>
		
		<!-- Form to submit product data -->
		<div id="product-form">
			<div class="form-group">
				<label for="product-name">Product Name</label>
				<input type="text" class="form-control" id="product-name" name="product_name">
			</div>
			<div class="form-group">
				<label for="quantity-in-stock">Quantity in Stock</label>
				<input type="number" class="form-control" id="quantity-in-stock" name="quantity_in_stock">
			</div>
			<div class="form-group">
				<label for="price-per-item">Price per Item</label>
				<input type="number" class="form-control" id="price-per-item" name="price_per_item" step="0.01">
			</div>
            <div id="alert-message" class="alert alert-danger d-none" ></div>
			<button type="button" class="btn btn-primary" onclick="ajaxForSendData()">Submit</button>
		</div>
		
		<!-- Table to display product data -->
        <h6 class="alert alert-info mt-5 mb-2"> press double click on any field to edit </h6>
		<table id="table" class="table">
			<thead>
				<tr>
					<th>Product Name</th>
					<th>Quantity in Stock</th>
					<th>Price per Item</th>
					<th>Date Time Submitted</th>
					<th>Total Value Number</th>
				</tr>
			</thead>
			<tbody id="product-list">
				<!-- This will be populated with the product data -->
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" class="text-right"><strong>Total Value:</strong></td>
					<td><strong id="total-value"></strong></td>
				</tr>
			</tfoot>
		</table>
	</div>
	
	<script>
        function ajaxForSendData() {
            // get values
            var product_name = document.getElementById("product-name").value;
            var quantity_in_stock = document.getElementById("quantity-in-stock").value;
            var price_per_item = document.getElementById("price-per-item").value;
            var alertDiv = document.getElementById("alert-message");
            var cls = alertDiv.getAttribute("class");

            // check if empty
            if ( product_name.trim() == "" || quantity_in_stock.trim() == "" || price_per_item.trim() == "" ) {
                alertDiv.innerHTML = "";
                cls = cls.replaceAll("d-none"," ",true);
                alertDiv.setAttribute("class", cls);
                alertDiv.innerHTML = "Please fill in all fields.";
            }else{
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("product-list").innerHTML = this.responseText;
                        // alert if success
                        cls = cls.replaceAll("d-none"," ",true);
                        cls = cls.replaceAll("danger","success",true);
                        alertDiv.setAttribute("class", cls);
                        alertDiv.innerHTML = "sent succesfully";
                    }
                    else{
                        cls = cls.replaceAll("d-none"," ",true);
                        cls = cls.replaceAll("success","danger",true);
                        alertDiv.setAttribute("class", cls);
                        alertDiv.innerHTML = "Send failed";
                    }
                    totalValue ();
                }
                xhttp.open("GET", "ajax/new.php?q=true&product_name="+product_name + "&quantity_in_stock=" + quantity_in_stock + "&price_per_item=" + price_per_item , true);
                xhttp.send();
            }
        }

        oninput = function hidAlert(){
            var alertDiv = document.getElementById("alert-message");
            alertDiv.innerHTML = "";
            var cls = alertDiv.getAttribute("class");
                cls = cls.replaceAll(" ","d-none",true);
                alertDiv.setAttribute("class", cls);
        }

        onload = function ajaxForGetData() {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById("product-list").innerHTML = this.responseText;
                totalValue ();
            }
            xhttp.open("GET", "ajax/new.php" , true);
            xhttp.send();
        }

        function totalValue (){
            // Select all elements that contain a total-value class
            var totalValueElements = document.querySelectorAll('.total-value');

            var totalValue = 0;

            // Sum the value of each item and add it to the total value
            for (var i = 0; i < totalValueElements.length; i++) {
                totalValue += parseFloat(totalValueElements[i].textContent);
            }

            // Display the total value in the desired item
            document.getElementById('total-value').textContent = totalValue;

        }
        // Edit function
        function edit(id, ProductName, QuantityInStock, PricePerItem, DateTimeSubmitted, TotalValueNumber ){
            var btn = document.getElementById(id);

            ProductName = document.getElementById(ProductName)
            ProductName.setAttribute("contentEditable", true);

            QuantityInStock = document.getElementById(QuantityInStock);
            QuantityInStock.setAttribute("contentEditable", true);

            PricePerItem = document.getElementById(PricePerItem);
            PricePerItem.setAttribute("contentEditable", true);

            DateTimeSubmitted = document.getElementById(DateTimeSubmitted);
            DateTimeSubmitted.setAttribute("contentEditable", true);

            TotalValueNumber = document.getElementById(TotalValueNumber);

            this.addEventListener("input", function() {
                this.event.target.style.background = "skyblue";
                btn.innerHTML = "save";
                btn.style.background = "orange";
                TotalValueNumber.innerHTML = PricePerItem.innerHTML * QuantityInStock.innerHTML;
                totalValue();
                console.log(id);
            });

            if( this.event.target.id == id ){
                if( btn.innerHTML == 'save' ){
                    const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        btn.innerHTML = this.responseText;;
                        btn.style.background = "blue";
                    }else{
                        btn.innerHTML = this.responseText;;
                        btn.style.background = "orange";
                    }
                    totalValue ();
                }
                xhttp.open("GET", "ajax/edit.php?row="+ id +"&product_name="+ProductName.innerHTML + "&quantity_in_stock=" + QuantityInStock.innerHTML + "&price_per_item=" + PricePerItem.innerHTML + "&datetime_submitted=" + DateTimeSubmitted.innerHTML , true);
                xhttp.send();
                }else{
                    btn.innerHTML = 'save';
                    btn.style.background = 'orange';
                }
            }
        }
    </script>
	
</body>
</html>