<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solution_submit_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function checkSolution($s_code)
    {
        $this->db->select("*");
        $this->db->from("solution");
        $this->db->where('solution_code', $s_code);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function checkAnswer($pid, $username)
    {
        $this->db->select("*");
        $this->db->from("c_learner_answer");
        $this->db->where('pid', $pid);
        $this->db->where('submitted_by', $username);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function checkAnswerCode($pid, $code, $username)
    {
        $this->db->select("*");
        $this->db->from("c_learner_answer");
        $this->db->where('pid', $pid);
        $this->db->where('answer_code', $code);
        $this->db->where('submitted_by', $username);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getresult($data)
    {
        $banned_words = "fclose fopen fread FILE readdir opendir DIR system dirent execl popen ofstream fstream ifstream socket netinet"; //etc
        if (preg_match('~\b(' . str_replace(' ', '|', $banned_words) . ')\b~', $data)) {
            echo "Blocked Words:".$banned_words ;
            return ;
        }
        $rpath="/var/www/html/pbel/gcc/";
        $rpath="./gcc/";
        //   $data = $_POST['data']; //extract the code from the form into a variable
        $args = "";//$_POST['args']; //extract the command-line arguments from the form into a variable
        $stdin= "";// $_POST['stdin']; //extract the standard input from the form into a variable
        $unique = rand(1, 10000); //generate a random number for the current execution session
        $file = "prog".$unique.".c"; //declare the file name
        $file = "prog.c"; //declare the file name
        $srcpath = $rpath.$file; //declare the source file path
        $executable = $rpath."prog.bin"; //declare the executable path
        $fp = fopen($srcpath, "w") or die("<p>Couldn't open  $srcpath for writing!</p>"); //open file for writing
        if(!fwrite($fp, $data)) //write the code to file
        {
            shell_exec("rm -rf $srcpath");
            die("<p>Couldn't write values to file!</p>"); //clean up and exit if unable to write
        }

        fclose($fp); //close and save the file
        // echo "<p>Saved to $file successfully!</p>"; //notify the user that file has been saved

        $output1 = shell_exec("g++ $srcpath -o $executable 2>&1");
        /* try compiling the program with GCC and collect errors and warnings */
        if($output1!=NULL)
        {
            echo "<pre>";
            echo "<b>Error list:</b><br>  ";
            echo wordwrap( $output1 ,60,"\n");
            echo "</pre>";
            //display the errors and warnings if present
        }
        echo "</pre>";
        if(file_exists($executable)) //check if executable exists
        {
            echo "<pre><b>Output:</b><br>";
            $output2 = shell_exec("echo $stdin | $executable $args 2>&1");
            /* execute the file providing the necessary inputs and collect the output */
            echo wordwrap( $output2 ,60,"<br>\n");
            echo  "</pre>";
        }
        shell_exec("rm -rf $srcpath $executable"); //clean up the session files
    }
    public function saveAnswer($data)
    {
        $this->db->insert('c_learner_answer', $data);
    }
    public function updateAnswer($pid, $user, $data)
    {
        $this->db->where('pid', $pid);
        $this->db->where('submitted_by', $user);
        $this->db->update('c_learner_answer', $data);
    }

    function __destruct() {
        $this->db->close();
    }
}