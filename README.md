List of api

get:
http://melvin.southeastasia.cloudapp.azure.com/api/categorylist
select all catergory list
![catlist](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/categorylist.PNG)

get: 
http://melvin.southeastasia.cloudapp.azure.com/api/activitylist/1
select all activity list where cat_id = 1
![actlist1](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/activitylist1.PNG)

get: 
http://melvin.southeastasia.cloudapp.azure.com/api/activitylist/2
select all activity list where cat_id = 2
![actlist2](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/activitylist2.PNG)

get:
http://melvin.southeastasia.cloudapp.azure.com/api/activitylist/3
select all activity list where cat_id = 3
![actlist3](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/activitylist3.PNG)

get: 
http://melvin.southeastasia.cloudapp.azure.com/api/activitylist/4
select all activity list where cat_id = 4
![actlist4](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/activitylist4.PNG)

get: 
http://melvin.southeastasia.cloudapp.azure.com/api/activitylist/5
select all activity list where cat_id = 5
![actlist5](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/activitylist5.PNG)

post: 
http://melvin.southeastasia.cloudapp.azure.com/api/goal/user
select goal where goal_id = goal_id
params: goal_id
![usergoal](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/usergoal.PNG)

post: 
http://melvin.southeastasia.cloudapp.azure.com/api/goal/add
insert goal where goal_id = goal_id
params: goal_description
        goal_unit
        goal_current_unit
        goal_unitType
        goal_frequency
        goal_priority
        goal_startdate
        goal_enddate
        goal_reminder
        goal_complete_pts
        goal_complete
        activity_id
        user_id
![addgoal](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/addgoal.PNG)
        
put: 
http://melvin.southeastasia.cloudapp.azure.com/api/goal/editgoal
update goal where goal_id = goal_id
params: goal_description
        goal_unit
        goal_current_unit
        goal_unitType
        goal_frequency
        goal_priority
        goal_startdate
        goal_enddate
        goal_reminder
![editgoal](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/editgoal.PNG)

put: 
http://melvin.southeastasia.cloudapp.azure.com/api/goal/updategoalcurrentunit
update goal_current_unit where goal_id = goal_id
params: goal_id
        goal_current_unit
![updatecurrentunit](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/updatecurrentunit.PNG)

put: 
http://melvin.southeastasia.cloudapp.azure.com/api/goal/updategoalpoint
update goal_current_unit where goal_id = goal_id
params: goal_id
        goal_complete_pts
![updategoalpoint](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/updategoalpoint.PNG)
 
put: 
http://melvin.southeastasia.cloudapp.azure.com/api/goal/stecompletegoal
update goal_current_unit where goal_id = goal_id
params: goal_id
        goal_complete
![setcompletegoal](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/setcompletegoal.PNG)

post: 
http://melvin.southeastasia.cloudapp.azure.com/api/user/login
select user_id, user_name where user_name = user_name and user_password = user_password
params: user_name
        user_password
![userlogin](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/userlogin.PNG)

get: 
http://melvin.southeastasia.cloudapp.azure.com/api/userall
select all user 
To view user_id, user_name and user_password - for testing only
![userall](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/userall.PNG)
        
