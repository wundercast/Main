<?php

// Stillll..... to present work, courses in better way ( another  database seperately for it with (date) from, (date) to, (short course/work description) and Title)



$user = '';     //database name
$pass = '';    //password_for_database
$dsn = ''; //destination of the_database
$db = ''; //name of database
$db2 = ''; //for general data used to connect the 2 databases
$sql1 = new mysqli($dsn, $user, $pass, $db);
$sql2 = new mysqli($dsn, $user, $pass, $db2);


class Profile //extends Registration
{       
        public function html($content)
	{
		
		$output = '<!DOCTYPE html>' 
				. PHP_EOL
				. '<head>' 
				. PHP_EOL
				. '<meta charset="utf-8">' 
				. PHP_EOL
				. '<title>Wundercast</title>' 
				. $content
				. PHP_EOL
				. '</head>' 
				. PHP_EOL
				.'</html>' 
				. PHP_EOL;
		return $output;
	}
	
	public function div($class, $contents)
	{
		return '<div class="' . $class . '">' 
			   . PHP_EOL
			   . $contents 
			   . PHP_EOL
			   . '</div><!-- end ' . $class . ' -->' 
			   . PHP_EOL;
	}
	
	
	public function buildForm($name, $action, $contents)
	{
		return '<form name="' . $name . '" action="' . $action . '" method="POST">' 
			   . PHP_EOL 
			   . $contents 
			   . PHP_EOL 
			   . '</form> ' 
			   . PHP_EOL;
	}
	
	
	public function input($label, $type, $name, $size, $maxLength, $value = NULL)
	{
		$output = '<div class="aRow">' 
				. PHP_EOL
				. '<div class="aCell label">' . $label . '</div>' 
				. PHP_EOL
				. '<div class="aCell formTd">' 
				. PHP_EOL
				.'<input type="' . $type . '" name="data[' . $name . ']" size=' . $size . ' maxlength=' . $maxLength . ' value="' . $value . '" />' 
				. PHP_EOL
				. '</div>' 
				. PHP_EOL
				. '</div>' 
				. PHP_EOL;
		return $output;
	}
	
		public function heads($value, $content)
				{
					echo '<h'. $value .'>'. $content .'</h' . $value . '>'; 
				}
		
	
	public function textArea($label, $name, $rows, $cols, $value = NULL)
	{
		$output = '<div class="aRow">' 
				. PHP_EOL
				. '<div class="aCell label">' . $label . '</div>' 
				. PHP_EOL
				. '<div class="aCell formTd">' 
				. PHP_EOL
				. '<textarea name="data[' . $name . ']" rows=' . $rows . ' cols=' . $cols . ' >'
				. $value
				. '</textarea>' 
				. PHP_EOL
				. '</div>' 
				. PHP_EOL
				. '</div>'
				. PHP_EOL;
		return $output;
	}
	
	
	public function submit($name, $value)
	{
		$output = '<div class="aRow">' 
				. PHP_EOL
				. '<div class="aCell label">&nbsp;</div>' 
				. PHP_EOL
				. '<div class="aCell formTd">' 
				. PHP_EOL
				. '<input type="submit" name="' . $name . '" value="' . $value . '" />'
				. PHP_EOL
				. '</div>' 
				. PHP_EOL
				. '</div>' 
				. PHP_EOL;
		return $output;
	}
	   
	
	    
		public function InputDa()
            {   
               if (isset($_POST['data']))
			    {
						// extract $_POST data into a variable
						$data = $_POST['data'];

				// sanatize data
				foreach ($data as $key => $value) 
					{
						$data[$key] = filter_var($value, FITLER_SANITIZE_STRING);
					}
	
			$person = $sql2->query("SELECT * FROM main_database");	
			$data = $person->fetch_object();
			$uid = $data->uid;
					
			$sql1->query("INSERT INTO users(about, work, skills, courses, video, uid) VALUES (:about, :workex, :skills, :courses, :vid, $uid)");
	
				

				// closes the database connection
				$sql1 = NULL;
			
				$dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'uploadpic';

				// Check to see if upload parameter specified
				if (isset($_FILES['uploadpic']) && $_FILES['uploadpic']['error'] == UPLOAD_ERR_OK)
				 {

					// Check to make sure file uploaded by upload process
					if (is_uploaded_file ($_FILES['uploadpic']['tmp_name'])) 
					   { 		
							// Capture user supplied filename
							$fn = basename($_FILES['uploadpic']['name']);

							// Move image to uploads folder
							$copyfile = $dir . DIRECTORY_SEPARATOR . $fn;
		
							// Move file
							move_uploaded_file ($_FILES['uploadpic']['tmp_name'], $copyfile);
					 			
					   }
					
				 }
				
			   }	
        	 
   			}
 
 
 		


		
		
		public function dcontent($head, $contents)
		 	{      						
				$output = '<table>'
					 		. PHP_EOL
				     		.'<tr><th>'. $head  .'</th></tr>' 
					 		. PHP_EOL
							. '<tr>'
					 		. '<td align="right">'. $contents .'</td>'
					 		. PHP_EOL
					 		. '</tr>' 
							. PHP_EOL
							. '</table>'
							. PHP_EOL;
						return $output;	
							
		   
			
		}
 
 
   
		
		


 
            
};

 
class View
{
	
		public function form()
		     { 
			 
					$form_input = new Profile;
					 		 		
					$formContents = $form_input->textArea('Short Description', 'about', 4, 40,'Tell Us About Yourself');
					$formContents .= $form_input->textArea('Work Experience', 'workex', 4, 40, 'Where All You Have Worked');
					$formContents .= $form_input->textArea('Skills', 'skills', 4, 40,'Tell Us About Your Skillset');
					$formContents .= $form_input->textArea('Related Courses', 'courses', 4, 40,'What You Have Done To Pursue Your Skills');
					$formContents .= $form_input->input('Link To A YouTube Video in Which You Show Off Your Skill To The World', 'text', 'vid', 50, 255, 'YouTube Link');
					$formContents .= $form_input->input('Upload A Photo', 'File', 'city', 20, 200, 'Picture');
 					$formContents .= $form_input->submit('submit', 'Submit');

					$formTable  = $form_input->buildForm('userInfo', $_SERVER['REQUEST_URI'], $form_input->div('aTable', $formContents));

					echo $form_input->html($formTable);
						
				    $form_input->InputDa();

			 }	 
			 
			 
		public function details()	
			
            {   
			
				$form_input = new Profile;

             /* $result1 = $sql1->query("SELECT work, about, skills, courses, video, uid FROM user");
				$output1 =  $result1->fetch_object();
				

               $result2 = $sql2->query("SELECT display_name, gender FROM main_database");
			   $output2 = $result2->fetch_object();
			   */
			   
			  $YouTube_video = '<iframe title="YouTube video player" class="youtube-player" type="text/html"'
			  					. ' width="640" height="390" src="$output2->video " '
								. ' frameborder="5" allowFullScreen></iframe>';
								
				 $mime = "image/jpeg";

				$b64Src = "data:".$mime.";base64," . base64_encode($row["img"]);
				
				echo '<img src="'.$b64Src.'" alt="" />';				
								
				$show = $form_input->dcontent('Name', '$output2->display_name');
				$show .= $form_input->dcontent('Gender', '$output2->gender');
				$show .= $form_input->dcontent('Description', '$output1->about');
				$show .= $form_input->dcontent('Work Experience',' $output1->work');
				$show .= $form_input->dcontent('Skills', '$output1->courses');
				
	
				
				echo $form_input->html($show.$YouTube_video);
				
				$dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'uploadpic';
				$images = glob("{$dir}*.png, {$dir}*.jpeg, {$dir}*.gif");
				foreach($images as $image) {
						echo '<img src="'.$image.'" /><br />';
				}
		   
		
		} 
			

};

$formView = new View;

 $formView->details();
 
$formView-> form();	


	
    

?>