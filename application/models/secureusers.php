<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secureusers extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function validate_user($username,$password)
    {
        $row = $this->db->get_where('users',array('username'=>$username,'password'=>$password))->row();
        if($this->db->affected_rows()==1)
            return $row;
        else
            return null;
    }
    function validate_username($username)
    {
        $row = $this->db->get_where('users',array('username'=>$username))->row();
        if($this->db->affected_rows()==1)
            return $row;
        else
            return null;
    }
    function get_user_details($user_id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('profiles', 'users.id = profiles.user_id','left');
        $this->db->where(array('users.id'=>$user_id));
        $query = $this->db->get();
        $row = $query->row();
        if($this->db->affected_rows()==1)
            return $row;
        else
            return null;
    }
    function get_student_details($student_bioid)
    {
        $this->db->select('users.id,gender,admission_no,roll_no,dob,address,blood_group,languages,nationality,category,religion,about_me,firstname,middlename,lastname,class_code,type,privilege,contact_nos,email,bioid,photourl');
        $this->db->from('users');
        $this->db->join('profiles', 'users.id = profiles.user_id','left');
        $this->db->where(array('users.bioid'=>$student_bioid,'type'=>STUDENT_TYPE));
        $query = $this->db->get();
        $row = $query->row();
        if($this->db->affected_rows()==1)
            return $row;
        else
            return null;
    }
    function set_user_details($user_id,$firstName,$lastName,$middleName,$dob,$gender,$email,$phone,$address,$bloodGroup,$languages,$nationality,$category,$religion,$aboutMe,$photo,$is_this_student)
    {
        $p = $this->session->userdata('privilege');
        if($p == PRV_STUDENT)
        {
            $data = array(
               'email' => $email
            );
            if($photo!="")
            {
                $data['photourl'] = $photo;
                $this->session->set_userdata('photourl',$photo);
            }
            $this->db->where('id',$user_id);
            $this->db->update('users',$data);
            
            $this->db->get_where('profiles',array('user_id'=>$user_id));
            $data = array(
               'user_id' => $user_id, 
               'languages' => $languages,
               'about_me' => $aboutMe
            );
            if($this->db->affected_rows()==0)
            {
                $this->db->insert('profiles', $data); 
            }
            else
            {
                $this->db->where('user_id',$user_id);
                $this->db->update('profiles',$data);
            }
        }
        else
        {
            $data = array(
               'firstname' => $firstName,
                'middlename' => $middleName,
                'lastname' => $lastName,
                'contact_nos' => $phone,
               'email' => $email ,
            );
            if($photo!="")
            {
                $data['photourl'] = $photo;
                if(!$is_this_student)
                    $this->session->set_userdata('photourl',$photo);
            }
            $this->db->where('id',$user_id);
            $this->db->update('users',$data);
            if(!$is_this_student)
            {
                $this->session->set_userdata('firstname',$firstName);
                $this->session->set_userdata('lastname',$lastName);
            }
            $this->db->get_where('profiles',array('user_id'=>$user_id));
            $data = array(
               'user_id' => $user_id, 
                'gender' => $gender,
                'dob' => $dob,
                'address' => $address,
                'blood_group' => $bloodGroup,
                'languages' => $languages,
                'nationality' => $nationality,
                'category' => $category,
                'religion' => $religion,
                'about_me' => $aboutMe
            );
            if($this->db->affected_rows()==0)
            {
                $this->db->insert('profiles', $data); 
            }
            else
            {
                $this->db->where('user_id',$user_id);
                $this->db->update('profiles',$data);
            }
        }
    }
    
    function update_account($user_id,$currUsername,$currPassword,$multilanguage,$newUsername,$newPassword)
    {
        $row = $this->db->get_where('users',array('id'=>$user_id,'username'=>$currUsername,'password'=>$currPassword))->row();
        if($this->db->affected_rows()==0)
            return 0;
        else
        {
            $data = array(
               'multilanguage' => $multilanguage,
            );
            if(isset($newUsername))
            {
                $data['username'] = $newUsername;
                $this->session->set_userdata('username',$newUsername);
            }
            if(isset($newPassword))
            {
                $data['password'] = $newPassword;
            }
            $this->db->where('id',$user_id);
            $this->db->update('users',$data);
            
            $this->session->set_userdata('multilanguage',$multilanguage);
            return 1;
        }
    }
    
    //Fetching all classes
    function get_classes()
    {
        $query = $this->db->get('classes');
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    //Fetching all teachers
    function get_teachers()
    {
        $query = $this->db->get_where('users',array('type'=>TEACHER_TYPE));
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    function get_students_inouttime_details($class_code,$date)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join($class_code, "users.bioid = ".$class_code.".bio_id");
        $this->db->where(array($class_code.'.date'=>$date,'users.type'=>STUDENT_TYPE));
        $this->db->group_by(array("users.id")); 
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    function get_students_ofa_class($class_code)
    {
        $this->db->select('id,rollno,firstname,middlename,lastname,bioid');
        $this->db->order_by('rollno ASC, firstname ASC,middlename ASC,lastname ASC');
        $query = $this->db->get_where('users',array('class_code'=>$class_code,'type'=>STUDENT_TYPE));
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    function get_subjects_ofa_class($class_code)
    {
        $this->db->select('id,bio_id,subject');
        $this->db->order_by('id ASC');
        $query = $this->db->get_where('teachers_subjects',array('class_code'=>$class_code));
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    function get_intime_ofa_student($class_code,$bio_id,$date_from,$date_to)
    {
        $query = "select `date` as x, `in_time` as y from `".$class_code."` group by `bio_id`,`date` having `bio_id` = ".$bio_id." and `date` BETWEEN '".$date_from."' AND '".$date_to."' order by `date` ASC";
        $result = $this->db->query($query);
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $result->result_array();
    }
    
    function get_outtime_ofa_student($class_code,$bio_id,$date_from,$date_to)
    {
        $query = "select `date` as x, `out_time` as y from `".$class_code."` group by `bio_id`,`date` having `bio_id` = ".$bio_id." and `date` BETWEEN '".$date_from."' AND '".$date_to."' order by `date` ASC";
        $result = $this->db->query($query);
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $result->result_array();
    }
    
    function get_selective_departments($bioid)
    {
        $this->db->select('departments.id,department_name');
        $this->db->from('departments');
        $this->db->join('department_teachers', 'departments.id = department_teachers.dept_id');
        $this->db->where(array('department_teachers.bioid'=>$bioid));
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();

    }
    function is_hod_of_dept($dept_id,$bio_id)
    {
        $query = $this->db->get_where('department_teachers',array('prv_type'=>'hod','dept_id'=>$dept_id,'bioid'=>$bio_id));
        if($this->db->affected_rows()==0)
        {
            return false;
        }
        else
            return true;
    }
    
    function get_selective_dept_classes($dept_id,$bio_id)
    {
        $this->db->select('classes.class_code,class AS classname,section');
        $this->db->from('classes');
        $this->db->join('department_classes', 'classes.class_code = department_classes.class_code');
        $this->db->where(array('department_classes.dept_id'=>$dept_id));
        //Get all class codes of the logged in teacher who is not HOD
        $this->db->where('classes.class_code IN (Select `class_code` from `teachers_subjects` where bio_id = '.$bio_id.')', NULL, FALSE); 
        $query = $this->db->get();
        
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    
    public function get_selective_non_dept_classes($bio_id)
    {
        $this->db->select('classes.class_code,class AS classname,section');
        $this->db->from('classes');
        $this->db->where('`class_code` NOT IN (Select distinct(`class_code`) from department_classes)', NULL, FALSE);
        //Get all class codes of the logged in teacher who is not HOD
        $this->db->where('classes.class_code IN (Select `class_code` from `teachers_subjects` where bio_id = '.$bio_id.')', NULL, FALSE); 
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    public function get_inout_att_records($class_code,$date_from,$date_to)
    {
        $this->db->select($class_code.'.bio_id,in_time,out_time,date');
        $this->db->from($class_code);
        $this->db->join('users','users.bioid = '.$class_code.".bio_id");
        $this->db->where('users.type =',STUDENT_TYPE);
        $this->db->where($class_code.'.date >=',$date_from);
        $this->db->where($class_code.'.date <=',$date_to);
        $this->db->group_by('bio_id , date');
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    public function get_all_subjects_of_this_class($class_code)
    {
        $this->db->select('subject');
        $this->db->from('teachers_subjects');
        $this->db->where('class_code = ',$class_code);
        //$this->db->group_by('class_code');
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    public function get_selective_subjects_of_this_class($class_code)
    {
        $this->db->select('subject');
        $this->db->from('teachers_subjects');
        $this->db->where('class_code = ',$class_code);
        $this->db->where('bio_id = ',$this->session->userdata('bioid'));
        $this->db->group_by('class_code');
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    public function get_subj_att_records($class_code,$subject,$date_from,$date_to)
    {
        $this->db->select($class_code.'.bio_id,time,slot,date');
        $this->db->from($class_code);
        $this->db->join('users','users.bioid = '.$class_code.".bio_id");
        $this->db->where('users.type =',STUDENT_TYPE);
        $this->db->where($class_code.'.date >=',$date_from);
        $this->db->where($class_code.'.date <=',$date_to);
        $this->db->where($class_code.'.subject = ',$subject);
        $this->db->group_by($class_code.'.bio_id , '.$class_code.'.date , '.$class_code.'.slot');
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    public function get_gauge_teacher_dashboard($classes)
    {
        $gauge_array = array();
        if(count($classes)!=0)
        {
            foreach($classes as $class)
            {
                $row_for_total = $this->db->query("select count(*) as count from users where class_code = '".$class['class_code']."' AND type = '".STUDENT_TYPE."'")->row_array();
                $subjects = $this->get_selective_subjects_of_this_class($class['class_code']);
                if(count($subjects)!=0)
                {
                    foreach($subjects as $subject)
                    {
                        $row_for_present = $this->db->query("select count(*) as count from (SELECT id from ".$class['class_code']." GROUP BY bio_id, date, slot, subject HAVING date = '".date('Y-m-d')."' and subject = '".$subject['subject']."') AS ROWS")->row_array();
                        if($row_for_present['count']=="0")
                            $percentage_present = 0;
                        else
                            $percentage_present = ($row_for_present['count'] / $row_for_total['count']) * 100;
                        $gauge_array[] = array('class_code' => $class['class_code'],'class_name' => $class['classname']." ".$class['section'],'subject' => $subject['subject'], 'percentage' => $percentage_present);
                    }
                }
            }
        }
        return $gauge_array;
    }
    
    public function get_total_no_classes($class_code,$subject,$date_from,$date_to)
    {
        $query = "Select count(*) as count from (SELECT count(*), subject FROM ".$class_code." WHERE date >= '".$date_from."' AND date <= '".$date_to."' AND subject='".$subject."' Group by date,slot,subject) as ROWS";
        return $this->db->query($query)->row_array();
    }
    
    public function get_this_subj_date_bioid_att($class_code,$subject,$thisdate,$bioid)
    {
        $this->db->select($class_code.'.bio_id,time,slot,date');
        $this->db->from($class_code);
        $this->db->join('users','users.bioid = '.$class_code.".bio_id");
        $this->db->where('users.type =',STUDENT_TYPE);
        $this->db->where($class_code.'.date =',$thisdate);
        $this->db->where($class_code.'.subject = ',$subject);
        $this->db->where($class_code.'.bio_id = ',$bioid);
        $this->db->group_by($class_code.'.bio_id , '.$class_code.'.date , '.$class_code.'.slot');
        $query = $this->db->get();
        if($this->db->affected_rows()==0)
        {
            return null;
        }
        else
            return $query->result_array();
    }
    
    public function create_quiz_db($multi_classes,$quiz_type,$quiz_title,$num_questions,$is_timed,$time_period)
    {
        $query = "Select max(quiz_id) as last_id from quiz_details";
        $row = $this->db->query($query)->row_array();
        if(!isset($row['last_id']))
            $quiz_id = 1;
        else {
            $quiz_id = $row['last_id'] + 1;
        }
        
        for($i=0; $i<count($multi_classes) ; $i++)
        {
            $this->db->insert('quiz_details',array('creator'=>$this->session->userdata('username'),'quiz_type'=>$quiz_type,'title'=>$quiz_title,'class_code'=>$multi_classes[$i],'is_timed'=>$is_timed,'time_period'=>$time_period,'quiz_id'=>$quiz_id,'questions_tobe_solved'=>$num_questions));
            
            $class_specific_quiz_id = $this->db->insert_id();
            
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'unsigned' => TRUE,
                ),
                'bio_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE
                ),
                'questions_attempted' => array(
                    'type' => 'INT',
                    'constraint' => '3'
                ),
                'correctly_answered' => array(
                    'type' => 'INT',
                    'constraint' => '3'
                ),
                'total' => array(
                    'type' => 'INT',
                    'constraint' => '3'
                ),
                'time_taken' => array(
                    'type' => 'TIME'
                ),
                'score' => array(
                    'type' => 'DOUBLE',
                ),
                'datetime' => array(
                    'type' => 'DATETIME DEFAULT CURRENT_TIMESTAMP',
                ),
            ));

            $this->dbforge->create_table('quiz_'.$class_specific_quiz_id.'_scores');
            $this->db->query('ALTER TABLE quiz_'.$class_specific_quiz_id.'_scores CHANGE `id` `id` INT(11) AUTO_INCREMENT PRIMARY KEY');
        }
        
        $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'unsigned' => TRUE,
                ),
                'question' => array(
                    'type' => 'TEXT',
                ),
                'opt_1' => array(
                    'type' => 'TEXT',
                ),
                'opt_2' => array(
                    'type' => 'TEXT',
                ),
                'opt_3' => array(
                    'type' => 'TEXT',
                ),
                'opt_4' => array(
                    'type' => 'TEXT',
                ),
                'answer' => array(
                    'type' => 'INT',
                    'constraint' => 1,
                ),
                'explanation' => array(
                    'type' => 'TEXT',
                ),
            ));

            $this->dbforge->create_table('quiz_'.$quiz_id.'_questions');
            $this->db->query('ALTER TABLE quiz_'.$quiz_id.'_questions CHANGE `id` `id` INT(11) AUTO_INCREMENT PRIMARY KEY');
            
            return $quiz_id;
    }
    
    public function get_created_quizes($creator)
    {
        return $this->db->query("SELECT id,title,quiz_id,created_datetime from quiz_details where creator='".$creator."' group by quiz_id")->result_array();
    }
    
    public function get_quiz_details($quiz_id)
    {
        return $this->db->query("SELECT id,creator,quiz_type,title,class_code,is_timed,time_period,quiz_id,questions_tobe_solved,is_active,created_datetime from quiz_details where quiz_id='".$quiz_id."' group by quiz_id")->row_array();
    }
    
    public function update_quiz_db($quiz_id,$quiz_type,$quiz_title,$num_questions,$is_timed,$time_period,$is_active)
    {
        $data = array(
                'quiz_type' => $quiz_type,
                'title' => $quiz_title,
                'questions_tobe_solved' => $num_questions,
                'is_timed' => $is_timed,
                'time_period' => $time_period,
                'is_active' => $is_active
            );
            
            $this->db->where('quiz_id',$quiz_id);
            $this->db->update('quiz_details',$data);
    }
    
    public function get_question_numbers($quiz_id)
    {
        return $this->db->query('SELECT id from quiz_'.$quiz_id.'_questions')->result_array();
    }
    
    public function submit_question($quiz_id,$question_id_flag,$question,$opt_1,$opt_2,$opt_3,$opt_4,$answer,$explanation)
    {
        if($question_id_flag=="")
            $this->db->insert('quiz_'.$quiz_id.'_questions',array('question'=>$question,'opt_1'=>$opt_1,'opt_2'=>$opt_2,'opt_3'=>$opt_3,'opt_4'=>$opt_4,'answer'=>$answer,'explanation'=>$explanation));
        else
        {
            $data = array('question'=>$question,'opt_1'=>$opt_1,'opt_2'=>$opt_2,'opt_3'=>$opt_3,'opt_4'=>$opt_4,'answer'=>$answer,'explanation'=>$explanation);
            $this->db->where('id',$question_id_flag);
            $this->db->update('quiz_'.$quiz_id.'_questions',$data);
        }
    }
    
    public function get_specific_question($quiz_id,$question_id)
    {
        return $this->db->query('SELECT * from quiz_'.$quiz_id.'_questions where id='.$question_id)->row_array();
    }
    
    public function publishquiz_notify($quiz_id)
    {
        $data = array(
                'is_active' => 1
            );
            
        $this->db->where('quiz_id',$quiz_id);
        $this->db->update('quiz_details',$data);
        
        $result = $this->db->query('SELECT class_code, title, quiz_type from quiz_details where quiz_id = '.$quiz_id)->result_array();
        
        foreach($result as $row)
        {
            $students = $this->db->query("SELECT id from users where type='student' AND class_code='".$row['class_code']."'")->result_array();
            
            foreach($students as $student)
            {
                if($row['quiz_type'] == 'p')
                    $message = "A practice quiz titled '".$row['title']."' has been published.";
                elseif($row['quiz_type'] == 'e')
                    $message = "An exam quiz titled '".$row['title']."' has been published.";
                
                $this->db->insert('notifications_quiz',array('notification'=>$message,'user_id'=>$student['id']));
            }
        }
    }
    
    public function get_unread_notifications_count()
    {
        $id = $this->session->userdata('id');
        $row_quiz = $this->db->query("SELECT count(*) as count from notifications_quiz as Q where Q.user_id=$id AND Q.read_flag=0")->row_array();
        $row_att = $this->db->query("SELECT count(*) as count from notifications_attendance as A where A.user_id=$id AND A.read_flag=0")->row_array();
        return $row_quiz['count'] + $row_att['count'];
    }
    
    public function get_total_notifications_count($user_id)
    {
        $row_quiz = $this->db->query("SELECT count(*) as count from notifications_quiz as Q where Q.user_id=$user_id")->row_array();
        $row_att = $this->db->query("SELECT count(*) as count from notifications_attendance as A where A.user_id=$user_id")->row_array();
        return $row_quiz['count'] + $row_att['count'];
    }
    
    public function get_five_notifications($user_id)
    {
        $quiz_notifications = $this->db->query("SELECT * from notifications_quiz as Q where Q.user_id=$user_id ORDER BY read_flag ASC, datetime DESC LIMIT 5")->result_array();
        $next_limit = 5 - count($quiz_notifications);
        $att_notifications =  $this->db->query("SELECT * from notifications_attendance as A where A.user_id=$user_id ORDER BY read_flag ASC, datetime DESC LIMIT $next_limit")->result_array();
        $data['quiz_notifications'] = $quiz_notifications;
        $data['att_notifications'] = $att_notifications;
        
        return $data;
    }
    
    public function get_exam_quizes($user_id)
    {
        $row = $this->db->query("SELECT class_code from users where id=$user_id")->row_array();
        $class_code = $row['class_code'];
        
        $result = $this->db->query("SELECT * from quiz_details where class_code='$class_code' AND quiz_type='e' AND is_active=1")->result_array();
        
        for($i=0; $i<count($result); $i++)
        {
            $idq = $result[$i]['id'];
            $bio_id = $this->session->userdata('bioid');
            $row = $this->db->query("SELECT count(*) as count, avg(score) as avg from quiz_".$idq."_scores where bio_id = $bio_id")->row_array();
            $result[$i]['attempts'] = $row['count'];
            $result[$i]['avgscore'] = $row['avg'];
        }
        
        return $result;
    }
    
    public function get_practice_quizes($user_id)
    {
        $row = $this->db->query("SELECT class_code from users where id=$user_id")->row_array();
        $class_code = $row['class_code'];
        
        $result = $this->db->query("SELECT * from quiz_details where class_code='$class_code' AND quiz_type='p' AND is_active=1")->result_array();
        
        for($i=0; $i<count($result); $i++)
        {
            $idq = $result[$i]['id'];
            $bio_id = $this->session->userdata('bioid');
            $row = $this->db->query("SELECT count(*) as count, avg(score) as avg from quiz_".$idq."_scores where bio_id = $bio_id")->row_array();
            $result[$i]['attempts'] = $row['count'];
            $result[$i]['avgscore'] = $row['avg'];
        }
        
        return $result;
    }
    
    public function grant_specific_quiz($username,$password,$idq,$bioid)
    {
        $this->db->get_where('users',array('username'=>$username,'password'=>$password));
        if($this->db->affected_rows() == 0)
            echo 'fail';
        else {
            $this->db->where(array('bio_id'=>$bioid));
            $this->db->delete('quiz_'.$idq.'_scores');
            echo 'success';
        }
    }
    
    public function check_quiz_attempts($idq,$bio_id)
    {
        $row = $this->db->query("SELECT count(*) as count from quiz_".$idq."_scores where bio_id = $bio_id")->row_array();
        return $row['count'];
    }
    public function attempt_entry_in_quiz($idq,$bio_id)
    {
        $this->db->insert('quiz_'.$idq.'_scores',array('bio_id'=>$bio_id));
        return $this->db->insert_id();
    }
    public function get_quiz_questions($quiz_id,$limit)
    {
        return $this->db->query('SELECT id,question,opt_1,opt_2,opt_3,opt_4 FROM quiz_'.$quiz_id.'_questions ORDER BY RAND() LIMIT '.$limit)->result_array();
    }
    public function check_answer($quiz_id,$qid,$qop)
    {
        $row = $this->db->query("SELECT count(*) as count FROM quiz_".$quiz_id."_questions WHERE id=$qid AND answer=$qop")->row_array();
        return $row['count'];
    }
    public function submit_score($idq,$attempt_id,$questions_attempted,$correctly_answered,$num_questions,$diff,$score)
    {
        $data = array(
            'questions_attempted' => $questions_attempted,
            'correctly_answered' => $correctly_answered,
            'total' => $num_questions,
            'time_taken' => $diff,
            'score' => $score
        );
        
        $this->db->where(array('id'=>$attempt_id,'total'=>0));
        $this->db->update('quiz_'.$idq.'_scores', $data); 
    }
    
    public function get_att_dboard($bio_id)
    {
        $date_from  = date('Y').'-'.date('n').'-01';
        $date_to  = date('Y').'-'.date('n').'-31';
        $row = $this->db->query("SELECT class_code from users where bioid=$bio_id")->row_array();
        $class_code = $row['class_code'];
        $subjects = $this->db->query("SELECT subject from $class_code group by subject")->result_array();
        for($i=0; $i<count($subjects); $i++)
        {
            $data = $this->db->query("Select count(*) as count from (SELECT count(*), subject FROM ".$class_code." WHERE date >= '".$date_from."' AND date <= '".$date_to."' AND subject='".$subjects[$i]['subject']."' Group by date,slot,subject) as ROWS")->row_array();
            $subjects[$i]['total'] = $data['count'];
            $data = $this->db->query("SELECT subject,count(*) as count FROM `$class_code` where bio_id = $bio_id AND date>'$date_from' AND date<'$date_to' AND subject='".$subjects[$i]['subject']."' group by subject")->row_array();
            if(count($data)>0)
                $subjects[$i]['attended'] = $data['count'];
            else
                $subjects[$i]['attended'] = 0;
        } 
        return $subjects;
    }
    
    public function get_escores_dboard($bio_id)
    {
        $row = $this->db->query("SELECT class_code from users where bioid=$bio_id")->row_array();
        $class_code = $row['class_code'];
        
        $result = $this->db->query("SELECT * from quiz_details where class_code='$class_code' AND quiz_type='e' ORDER BY created_datetime DESC limit 10")->result_array();
        
        for($i=0; $i<count($result); $i++)
        {
            $idq = $result[$i]['id'];
            $bio_id = $this->session->userdata('bioid');
            $row = $this->db->query("SELECT score from quiz_".$idq."_scores where bio_id = $bio_id group by bio_id")->row_array();
            if(isset($row['score']))
                $result[$i]['score'] = $row['score'];
            else
                $result[$i]['score'] = 0;
            $row = $this->db->query("SELECT max(score) as maxscore, avg(score) as avgscore from quiz_".$idq."_scores")->row_array();
            
            $result[$i]['maxscore'] = $row['maxscore'];
            $result[$i]['avgscore'] = $row['avgscore'];
        }
        
        return $result;
    }
}


?>