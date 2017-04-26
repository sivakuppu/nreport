<?php
class Payslip extends CI_Controller {
	
	/*public function index() {
		$file = 'D:/xampp/htdocs/test/nreport/NES_DB/PAYSLIP_NESPL.csv';
	}*/

	public function index()
	{
		$this->load->view('pay/pay_u_form', array('error' => ' ' ));
	}

	public function do_upload()
	{
			$config['upload_path']          = './NES_DB/ps/';
			$config['allowed_types']        = 'csv';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('userfile'))
			{
					$error = array('error' => $this->upload->display_errors());

					$this->load->view('pay/pay_u_form', $error);
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				if(isset($data['upload_data']['full_path'])) {
					echo $data['upload_data']['full_path'];
					$this->_rfile($data['upload_data']['full_path']);
				}	
			}
	}

	private function _rfile($file) {
		if($file && file_exists($file)) {

			$strPath = realpath(basename(getenv($_SERVER["SCRIPT_NAME"])));
			com_load_typelib('Word.Application');
			$com = new COM("Word.Application");
			$com->Application->Visible = FALSE;
			$documents = $com->Documents->Add();
			$com->Selection->PageSetup->LeftMargin = "0.50";
			$com->Selection->PageSetup->RightMargin = "0.50";
			$com->Selection->PageSetup->TopMargin = "0.50";
			$com->Selection->PageSetup->BottomMargin = "0.50";
			$com->Selection->Font->Name = "Calibri";
			$com->Selection->Font->Size = 11;

		
			//echo $file;
			ini_set('auto_detect_line_endings',TRUE);
			$handle = fopen($file,'r');
			$k = 0;
			$header = array();
			while ( ($data = fgetcsv($handle) ) !== FALSE ) {
				if($k == 0) {
					if(!empty($data)) {
						foreach($data as $h) {
							$header[] = $this->_clean($h);
						}
						//print_r($header);
					}	
				}
				else {
					$row_data = array_combine($header, $data);
					//print_r($row_data);
					$this->_getTable($com, $documents, $row_data);
				}	
				if($k%2 != 1) {
					$range = $documents->Paragraphs->Add->Range;  
					$range->InsertBefore(chr(13));
				}
				$k++;
			}
			ini_set('auto_detect_line_endings',FALSE);

			$documents->SaveAs("D:/xampp/htdocs/test/nreport/NES_DB/abc.doc");
			$com->Application->Quit;
		}
		else{
			die("File doesn't exists.");
		}	
	}
	private function _clean($string) {
		$string = strtoupper($string);
		$string = str_replace(' ', '-', $string);
		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
		return preg_replace('/-+/', '', $string);
	}
	
	private function _gen() {
		$strPath = realpath(basename(getenv($_SERVER["SCRIPT_NAME"])));
		com_load_typelib('Word.Application');
		$com = new COM("Word.Application");
		$com->Application->Visible = FALSE;
		$documents = $com->Documents->Add();
		$com->Selection->PageSetup->LeftMargin = "0.50";
		$com->Selection->PageSetup->RightMargin = "0.50";
		$com->Selection->PageSetup->TopMargin = "0.50";
		$com->Selection->PageSetup->BottomMargin = "0.50";
		$com->Selection->Font->Name = "Calibri";
		$com->Selection->Font->Size = 11;
		
		$items = array(1,2,3,4);
		foreach($items as $k => $item) {
			$this->_getTable($com, $documents);
			if($k%2 != 1) {
				$range = $documents->Paragraphs->Add->Range;  
				$range->InsertBefore(chr(13));
			}
		}	
		//$this->_getTable2($com, $documents);
		$documents->SaveAs("D:/xampp/htdocs/test/nreport/NES_DB/abc.doc");
		$com->Application->Quit;
	}


	private function _getTable($com, $documents, $ps_data) {
		
		extract($ps_data);
		
		$range = $documents->Paragraphs->Add->Range;
		//Row 1
		$table = $com->ActiveDocument->Tables->Add($range,1,3,1,2);
		$table->Cell(1,1)->Range->InsertAfter("Name and Address of the Establishment");
		$com->Selection->InlineShapes->AddPicture(realpath(FCPATH . "/images/n.jpg"), FALSE, TRUE, $table->Cell(1,2)->Range);
		$table->Cell(1,3)->Range->InsertAfter("NIREEKSHAN ENGINEERING SERVICES PVT LTD NEW: 259, OLD: 125, III FLOOR,LINGHI CHETTY STREET, CHENNAI - 600001");
		$documents->Tables->Item(1)->Rows->Alignment = 1;
		//$table->Cell(1,3)->setWidth(0.019 ,0);
		//$table->Cell(1,3)->width = 0.70;
		
		$com->ActiveDocument->Tables(1)->PreferredWidthType= 2; 
		$com->ActiveDocument->Tables(1)->PreferredWidth = 100; 
		//$com->ActiveDocument->Tables(1)->Columns(1)->PreferredWidth = 25; 
		//$com->ActiveDocument->Tables(1)->Columns(2)->PreferredWidth = 5; 
		//$com->ActiveDocument->Tables(1)->Columns(3)->PreferredWidth = 70; 
		$range = $documents->Paragraphs->Add->Range;
		
		//Row 2
		$table = $com->ActiveDocument->Tables->Add($range,1,1,1,2);
		$table->Cell(1,1)->Range->InsertAfter("PAY SLIP FOR THE MONTH OF JUNE 2016");
		$table->Cell(1,1)->Range->Font->Bold=TRUE;
		$table->Cell(1,1)->Range->Font->Size=12;
		$table->Cell(1,1)->Range->ParagraphFormat->Alignment = 1;
		$table->Cell(1,1)->Range->ParagraphFormat->SpaceBefore = 3;
		$table->Cell(1,1)->Range->ParagraphFormat->SpaceAfter = 3;
		
		
		$range = $documents->Paragraphs->Add->Range;
		//Row 3 to 5
		$table = $com->ActiveDocument->Tables->Add($range,3,4,1,2);
		$table->Cell(1,1)->Range->InsertAfter("Employee Name");
		$table->Cell(1,2)->Range->InsertAfter($NAME);
		$table->Cell(1,3)->Range->InsertAfter("PF Number");
		$table->Cell(1,4)->Range->InsertAfter($PFNUMBER);

		$table->Cell(2,1)->Range->InsertAfter("Designation");
		$table->Cell(2,2)->Range->InsertAfter($DESIGNATION);
		$table->Cell(2,3)->Range->InsertAfter("Bank AC / Cheque No.");
		$table->Cell(2,4)->Range->InsertAfter($BANKACCHEQUENO);

		$table->Cell(3,1)->Range->InsertAfter("DOJ");
		$table->Cell(3,2)->Range->InsertAfter($DOJ);
		$table->Cell(3,3)->Range->InsertAfter("No of Working Days");
		$table->Cell(3,4)->Range->InsertAfter($NOOFWORKINGDAYS);

		$range = $documents->Paragraphs->Add->Range;
		//Row 6 to 16
		$table = $com->ActiveDocument->Tables->Add($range,11,4,1,2);
		$table->Cell(1,1)->Range->InsertAfter("Earnings");
		$table->Cell(1,2)->Range->InsertAfter("Amount (Rs)");
		$table->Cell(1,3)->Range->InsertAfter("Deductions");
		$table->Cell(1,4)->Range->InsertAfter("Amount (Rs)");
		$table->Cell(1,1)->Range->Font->Bold=TRUE;
		$table->Cell(1,2)->Range->Font->Bold=TRUE;
		$table->Cell(1,3)->Range->Font->Bold=TRUE;
		$table->Cell(1,4)->Range->Font->Bold=TRUE;
		
		$table->Cell(1,2)->Range->ParagraphFormat->Alignment = 2;
		$table->Cell(1,4)->Range->ParagraphFormat->Alignment = 2;
		
		$table->Cell(2,1)->Range->InsertAfter("Basic");
		//$table->Cell(2,2)->Range->InsertAfter(money_format("%i",$BASIC));
		$table->Cell(2,2)->Range->InsertAfter($BASIC);
		$table->Cell(2,3)->Range->InsertAfter("PF Contribution");
		$table->Cell(2,4)->Range->InsertAfter($PF);

		$table->Cell(2,2)->Range->ParagraphFormat->Alignment = 2;
		$table->Cell(2,4)->Range->ParagraphFormat->Alignment = 2;

		
		$table->Cell(3,1)->Range->InsertAfter("Dearness Allowance (DA)");
		$table->Cell(3,2)->Range->InsertAfter("");
		$table->Cell(3,3)->Range->InsertAfter("ESI Contribution");
		$table->Cell(3,4)->Range->InsertAfter(" - ");

		$table->Cell(3,2)->Range->ParagraphFormat->Alignment = 2;
		$table->Cell(3,4)->Range->ParagraphFormat->Alignment = 2;
		
		$table->Cell(4,1)->Range->InsertAfter("House Rent Allowance (HRA)");
		$table->Cell(4,2)->Range->InsertAfter($HRA);
		$table->Cell(4,3)->Range->InsertAfter("Professional Tax");
		$table->Cell(4,4)->Range->InsertAfter(" - ");

		$table->Cell(4,2)->Range->ParagraphFormat->Alignment = 2;
		$table->Cell(4,4)->Range->ParagraphFormat->Alignment = 2;
		
		$table->Cell(5,1)->Range->InsertAfter("Special Allowance");
		$table->Cell(5,2)->Range->InsertAfter(" - ");
		$table->Cell(5,3)->Range->InsertAfter("Tax Deducted at Source (TDS)");
		$table->Cell(5,4)->Range->InsertAfter($TDS);

		$table->Cell(5,2)->Range->ParagraphFormat->Alignment = 2;
		$table->Cell(5,4)->Range->ParagraphFormat->Alignment = 2;

		
		$table->Cell(6,1)->Range->InsertAfter("Travelling Allowance");
		$table->Cell(6,2)->Range->InsertAfter($TA);
		$table->Cell(6,3)->Range->InsertAfter("Salary Advance");
		$table->Cell(6,4)->Range->InsertAfter($ADVANCE);

		$table->Cell(6,2)->Range->ParagraphFormat->Alignment = 2;
		$table->Cell(6,4)->Range->ParagraphFormat->Alignment = 2;

		
		$table->Cell(7,1)->Range->InsertAfter("ST. Bonus / Ex-gratia");
		$table->Cell(7,2)->Range->InsertAfter(" - ");
		$table->Cell(7,3)->Range->InsertAfter("Others");
		$table->Cell(7,4)->Range->InsertAfter(" - ");

		$table->Cell(7,2)->Range->ParagraphFormat->Alignment = 2;
		$table->Cell(7,4)->Range->ParagraphFormat->Alignment = 2;

		$table->Cell(8,1)->Range->InsertAfter("Leave Encashment");
		$table->Cell(8,2)->Range->InsertAfter(" - ");
		$table->Cell(8,3)->Range->InsertAfter("");
		$table->Cell(8,4)->Range->InsertAfter("");

		$table->Cell(8,2)->Range->ParagraphFormat->Alignment = 2;
		$table->Cell(8,4)->Range->ParagraphFormat->Alignment = 2;
		
		$table->Cell(9,1)->Range->InsertAfter("Others");
		$table->Cell(9,2)->Range->InsertAfter(" - ");
		$table->Cell(9,3)->Range->InsertAfter("Total Deductions");
		$table->Cell(9,4)->Range->InsertAfter($TOTALDEDUCTION);

		$table->Cell(9,2)->Range->ParagraphFormat->Alignment = 2;
		$table->Cell(9,4)->Range->ParagraphFormat->Alignment = 2;
		
		$table->Cell(10,1)->Range->InsertAfter("");
		$table->Cell(10,2)->Range->InsertAfter("");
		$table->Cell(10,3)->Range->InsertAfter("");
		$table->Cell(10,4)->Range->InsertAfter("");

		$table->Cell(11,1)->Range->InsertAfter("Gross Pay");
		$table->Cell(11,2)->Range->InsertAfter($GROSSSALARY);
		$table->Cell(11,3)->Range->InsertAfter("Net Pay");
		$table->Cell(11,4)->Range->InsertAfter($NETSALARY);

		$table->Cell(11,2)->Range->ParagraphFormat->Alignment = 2;
		$table->Cell(11,4)->Range->ParagraphFormat->Alignment = 2;

		$table->Cell(11,1)->Range->Font->Bold=TRUE;
		$table->Cell(11,2)->Range->Font->Bold=TRUE;
		$table->Cell(11,3)->Range->Font->Bold=TRUE;
		$table->Cell(11,4)->Range->Font->Bold=TRUE;

		
		$range = $documents->Paragraphs->Add->Range;
		
		//Row 17
		$table = $com->ActiveDocument->Tables->Add($range,1,4,1,2);
		$table->Cell(1,1)->Range->InsertAfter("");
		$table->Cell(1,2)->Range->InsertAfter("");
		$table->Cell(1,3)->Range->InsertAfter("");
		$table->Cell(1,4)->Range->InsertAfter("");
		
		$range = $documents->Paragraphs->Add->Range;
		
		//Row 18 to 23
		$table = $com->ActiveDocument->Tables->Add($range,5,6,1,2);
		$table->Cell(1,1)->Range->InsertAfter("");
		$table->Cell(1,2)->Range->InsertAfter("");
		$table->Cell(1,3)->Range->InsertAfter("");
		$table->Cell(1,4)->Range->InsertAfter("");
		$table->Cell(1,5)->Range->InsertAfter("");
		$table->Cell(1,6)->Range->InsertAfter("");

		$table->Cell(1,1)->Borders(-4)->LineStyle  = FALSE;
		$table->Cell(1,2)->Borders(-4)->LineStyle  = FALSE;
		$table->Cell(1,3)->Borders(-4)->LineStyle  = FALSE;
		$table->Cell(1,4)->Borders(-4)->LineStyle  = FALSE;
		$table->Cell(1,5)->Borders(-4)->LineStyle  = FALSE;
		$table->Cell(1,6)->Borders(-1)->LineStyle  = FALSE;
		
		$table->Cell(2,1)->Range->InsertAfter("Leave Details");
		$table->Cell(2,2)->Range->InsertAfter("CL");
		$table->Cell(2,3)->Range->InsertAfter("SL");
		$table->Cell(2,4)->Range->InsertAfter("PL");
		$table->Cell(2,5)->Range->InsertAfter("ML");
		$table->Cell(2,6)->Range->InsertAfter("");
		
		$table->Cell(2,1)->Range->Font->Bold=TRUE;
		$table->Cell(2,2)->Range->Font->Bold=TRUE;
		$table->Cell(2,3)->Range->Font->Bold=TRUE;
		$table->Cell(2,4)->Range->Font->Bold=TRUE;
		$table->Cell(2,5)->Range->Font->Bold=TRUE;

		$table->Cell(2,6)->Borders(-1)->LineStyle  = FALSE;
		
		$table->Cell(3,1)->Range->InsertAfter("Opening");
		$table->Cell(3,2)->Range->InsertAfter("");
		$table->Cell(3,3)->Range->InsertAfter("");
		$table->Cell(3,4)->Range->InsertAfter("");
		$table->Cell(3,5)->Range->InsertAfter("");
		$table->Cell(3,6)->Range->InsertAfter("");

		$table->Cell(3,1)->Range->Font->Bold=TRUE;
		$table->Cell(3,6)->Borders(-1)->LineStyle  = FALSE;
		
		$table->Cell(4,1)->Range->InsertAfter("Leave Taken");
		$table->Cell(4,2)->Range->InsertAfter("");
		$table->Cell(4,3)->Range->InsertAfter("");
		$table->Cell(4,4)->Range->InsertAfter("");
		$table->Cell(4,5)->Range->InsertAfter("");
		$table->Cell(4,6)->Range->InsertAfter("");		

		$table->Cell(4,1)->Range->Font->Bold=TRUE;
		$table->Cell(4,6)->Borders(-1)->LineStyle  = FALSE;
				
		$table->Cell(5,1)->Range->InsertAfter("Closing");
		$table->Cell(5,2)->Range->InsertAfter("");
		$table->Cell(5,3)->Range->InsertAfter("");
		$table->Cell(5,4)->Range->InsertAfter("");
		$table->Cell(5,5)->Range->InsertAfter("");
		$table->Cell(5,6)->Range->InsertAfter("");		

		$table->Cell(5,1)->Range->Font->Bold=TRUE;
		$table->Cell(5,6)->Borders(-1)->LineStyle  = FALSE;
				
		$range = $documents->Paragraphs->Add->Range;
		
		//Row 2
		$table = $com->ActiveDocument->Tables->Add($range,1,1,1,2);
		$table->Cell(1,1)->Range->InsertAfter("This is a computer-generated payslip and does not require a signature.");

		$table->Cell(1,1)->Range->Font->Bold=TRUE;
		$table->Cell(1,1)->Range->Font->Italic = TRUE;
		$table->Cell(1,1)->Range->ParagraphFormat->SpaceBefore = 1;
		$table->Cell(1,1)->Range->ParagraphFormat->SpaceAfter = 1;

	}	
}	
?>