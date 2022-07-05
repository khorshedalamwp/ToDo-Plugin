<?php
/**
 * All Functions
 *
 * @author Md Khorshed Alam
 */

defined( 'ABSPATH' ) || exit;

		function custom_css(){ ?>
			<form action="" method="post">
			<div class="css-sheets">
		    <h1>Select Custom Color ::</h1>
		    <div class="title-field">
			    <span>Title Color :</span>
			    <input type="text" value="#bada55" class="my-color-field" />
		</div>
				<div class="content-field">
			    <span>Content Color :</span>
			<input type="text" name="content-field" value="">
		</div>
				<div class="dificulty-field">
					<span>Dificulty Color :</span>
					<input type="text" name="dificulty-field" value="">
				</div>
				<div class="category-field">
					<span>Category Color :</span>
					<input type="text" name="category-field" value="">
				</div>
	       </div>
				<div class="color-submited">
					<button type="submit" name="submit" value="Filter">Submit</button>
				</div>
			</form>
	<?php	}

?>