import pytest
import System

#Nick Allegretti
#2/25/2020
#Assignment 5


#10 Required functions
def test_login(grading_system):
    username = 'cmhbf5'
    password = 'bestTA'
    grading_system.login(username, password)
    assert grading_system.usr.name == username

def test_password(grading_system):
    username = 'cmhbf5'
    password = 'bestTA'
    assert grading_system.check_password(username, password)

def test_change_grade(grading_system):
    staffUsername= 'cmhbf5'
    staffPassword= 'bestTA'
    
    user= 'akend3'
    userPassword= '123454321'
    course= 'comp_sci'
    assignment = 'assignment1'
    newGrade= 88


    grading_system.login(staffUsername, staffPassword)
    grading_system.usr.change_grade(user, course, assignment, newGrade)

    grading_system.reload_data

    grading_system.login(user, userPassword)
    #Dictionary gets data from grade
    assert grading_system.usr.users[user]['courses'][course][assignment]["grade"] == newGrade

def test_create_assignment(grading_system):
    staffUsername= 'cmhbf5'
    staffPassword= 'bestTA'
    AName= 'assignment10'
    ADueDate= '05/10/20'
    ACourse= 'comp_sci'

    grading_system.login(staffUsername, staffPassword)
    grading_system.usr.create_assignment(AName, ADueDate, ACourse)

    grading_system.reload_data

    assert AName in grading_system.usr.all_courses[ACourse]['assignments']

def test_add_student(grading_system):
    profUsername= 'calyam'
    profPassword= '#yeet'

    studentUsername= 'akend3'
    studentCourse= 'cloud_computing'
    
    
    grading_system.login(profUsername, profPassword)
    grading_system.usr.add_student(studentUsername, studentCourse)

    grading_system.reload_data
    
    assert studentCourse in grading_system.usr.users[studentUsername]['courses'] 

def test_drop_student(grading_system):
    profUsername= 'calyam'
    profPassword= '#yeet'

    studentUsername= 'yted91'
    studentCourse= 'cloud_computing'

    grading_system.login(profUsername, profPassword)
    grading_system.usr.drop_student(studentUsername, studentCourse)

    grading_system.reload_data

    assert studentCourse not in grading_system.usr.users[studentUsername]['courses']

def test_submit_assignment(grading_system):
    user= 'akend3'
    password= '123454321'
    
    course='comp_sci'
    assignment= 'assignment1'
    submission= 'Test Submission'


    grading_system.login(user, password)
    grading_system.usr.submit_assignment(course, assignment, submission, '2/25/2020')

    grading_system.reload_data

    assert submission == grading_system.usr.users[user]['courses'][course][assignment]["submission"]

def test_check_grades(grading_system):
    user= 'akend3'
    password= '123454321'

    course='databases'
    correctGrades= [['assignment1',23], ['assignment2',46]]

    grading_system.login(user, password)
    assert grading_system.usr.check_grades(course) == correctGrades

def test_view_assignments(grading_system):
    user= 'akend3'
    password= '123454321'
    
    course1='databases'
    course2='comp_sci'

    grading_system.login(user, password)
    assert not (grading_system.usr.view_assignments(course1) == grading_system.usr.view_assignments(course2))

def test_check_ontime(grading_system):
    user = 'akend3'
    password= '123454321'

    submission= '5/3/20'
    due = '4/3/20'

    from datetime import datetime as dt
    s= dt.strptime(submission, "%m/%d/%y")
    d= dt.strptime(due, "%m/%d/%y")
    
    grading_system.login(user,password)
    if (s<d) and  grading_system.usr.check_ontime(submission, due):
        assert True
    else:
        assert False


#My own tests start here

def test_bad_login(grading_system):
    user='na4nn'
    password='One'

    grading_system.login(user, password)
    assert grading_system.usr.name == user

def test_student_view_fake_course(grading_system):
    user='akend3'
    password= '123454321'
    
    fakeCourse= 'Math'
    grading_system.login(user,password)
    if(grading_system.usr.view_assignments(fakeCourse) == null):
        assert False
    else:
        assert True

def test_login_with_wrong_password(grading_system):
    user= 'akend3'
    password= '543212345'

    grading_system.login(user, password)
    assert grading_system.usr.name == user

def test_check_grades_for_fake_course(grading_system):
    user='cmhbf5'
    password='bestTA'
    fakeCourse='Math'
    
    grading_system.login(user,password)

    if(grading_system.usr.check_grades == null):
        assert False
    else:
        assert True

def test_check_wrong_password(grading_system):
    user ='cmhbf5'
    password= 'TABest'
    assert grading_system.check_password(user, password)

@pytest.fixture
def grading_system():
    gradingSystem= System.System()
    gradingSystem.load_data()
    return gradingSystem
