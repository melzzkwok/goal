List of api

get:
http://melvin.southeastasia.cloudapp.azure.com/api/categorylist
select all catergory list

get: 
http://melvin.southeastasia.cloudapp.azure.com/api/activitylist/1
select all activity list where cat_id = 1

get: 
http://melvin.southeastasia.cloudapp.azure.com/api/activitylist/2
select all activity list where cat_id = 2

get:
http://melvin.southeastasia.cloudapp.azure.com/api/activitylist/3
select all activity list where cat_id = 3

get: 
http://melvin.southeastasia.cloudapp.azure.com/api/activitylist/4
select all activity list where cat_id = 4

get: 
http://melvin.southeastasia.cloudapp.azure.com/api/activitylist/5
select all activity list where cat_id = 5

post: 
http://melvin.southeastasia.cloudapp.azure.com/api/goal/user
select goal where goal_id = goal_id
params: goal_id

post: 
http://melvin.southeastasia.cloudapp.azure.com/api/goal/add
insert goal where goal_id = goal_id
params: goal_id
        goal_description
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
![addgoal](https://user-images.githubusercontent.com/24829858/35620342-e115ffc6-06bb-11e8-9c9b-1e36a2cb66f5.PNG)

put: 
http://melvin.southeastasia.cloudapp.azure.com/api/goal/updategoalcurrentunit
update goal_current_unit where goal_id = goal_id
params: goal_id
        goal_current_unit
        
post: 
http://melvin.southeastasia.cloudapp.azure.com/api/user/login
select user_id, user_name where user_name = user_name and user_password = user_password
params: user_name
        user_password
        
get: 
http://melvin.southeastasia.cloudapp.azure.com/api/userall
select all user 
To view user_id, user_name and user_password - for testing only
        
