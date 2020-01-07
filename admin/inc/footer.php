<div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/Chart.bundle.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/app.js"></script>
    <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    function preload_modal(email,editID) {
    	$('#catName').val(email);
    	$('#catID').val(editID);
    }
    function quantity_load(qun,editID) {
    	$('#quantity').val(qun);
    	$('#productID').val(editID);
    	console.log(editID);
    }
    function vaccine_load(date,resason,no,desc,id) {
    	$('#date').val(date);
    	$('#resason').val(resason);
    	$('#no').val(no);
    	$('#desc').val(desc);
    	$('#id').val(id);
    }
    function egg_load(collected,good,bad,date_create,id) {
        $('#collected').val(collected);
        $('#good').val(good);
        $('#bad').val(bad);
        $('#date_create').val(date_create);
        $('#id').val(id);
    }
    function expenses_load(title,cat,quantity,amount,method,froms,id) {
        $('#title').val(title);
        $('#cat').val(cat);
        $('#quantity').val(quantity);
        $('#amount').val(amount);
        $('#method').val(method);
        $('#from').val(froms);
        $('#id').val(id);
    }
   
</script>
</body>
</html>