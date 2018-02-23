## List of api

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
select goal where goal_id = goal_id and goal_complete = 0 //0 = goal not completed  
**params: user_id**  
![usergoal](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/usergoal.PNG)

post: 
http://melvin.southeastasia.cloudapp.azure.com/api/goal/userhistory  
select goal where goal_id = goal_id and goal_complete = 1 //1 = goal completed  
//goals that are completed will appear in history  
**params: user_id**  
![userhistory](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/userhistory.PNG)

post:  
http://melvin.southeastasia.cloudapp.azure.com/api/goal/add  
insert goal where goal_id = goal_id  
// return response goal_id  
**params: goal_description, 
        goal_unit,  
        goal_unitType, 
        goal_frequency, 
        goal_priority, 
        goal_startdate, 
        goal_enddate, 
        goal_reminder, 
        activity_id, 
        user_id**  
![addgoal](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/addgoal.PNG)
        
put:  
http://melvin.southeastasia.cloudapp.azure.com/api/goal/editgoal  
update goal where goal_id = goal_id  
**params: goal_description, 
        goal_unit, 
        goal_current_unit, 
        goal_unitType, 
        goal_frequency, 
        goal_priority, 
        goal_startdate, 
        goal_enddate, 
        goal_reminder**  
![editgoal](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/editgoal.PNG)

put:  
http://melvin.southeastasia.cloudapp.azure.com/api/goal/updategoalcurrentunit  
update goal_current_unit where goal_id = goal_id  
**params: goal_id, 
        goal_current_unit**  
![updatecurrentunit](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/updatecurrentunit.PNG)

put:  
http://melvin.southeastasia.cloudapp.azure.com/api/goal/updategoalpoint  
update goal.goal_complete_pts and user.rewardtotal_point where goal_id = goal_id and user_id = user_id  
//goal_complete_pts will be added and incremented into rewardtotal_point  
//rewardtotal_point = rewardtotal_point + goal_complete_pts  
**params: goal_id, 
        goal_complete_pts**  
![updategoalpoint](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/updategoalpoint.PNG)
 
put:  
http://melvin.southeastasia.cloudapp.azure.com/api/goal/setcompletegoal  
update goal_complete where goal_id = goal_id  
//set goal_complete to 1(goal completed)  
**params: goal_id**  
![setcompletegoal](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/setcompletegoal.PNG)

put:  
http://melvin.southeastasia.cloudapp.azure.com/api/goal/goalreadd  
update goal_complete where goal_id = goal_id  
//set goal_complete to 0(goal not completed)  
//re add goal that was completed  
**params: goal_id**  
![readdgoal](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/readdgoal.PNG)

post:  
http://melvin.southeastasia.cloudapp.azure.com/api/goal/progressgraph  
insert progress.progress_unit, progress.goal_id into progress where progress.goal_id = goal.goal_id and progress.progress_unit = goal.goal_current_unit and goal.goal_complete = 0  
// to be called automatically at 00.00 to store the current progress of the goal of that day  
**params: user_id**  
![progressgraph](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/progressgraph.PNG)

post:  
http://melvin.southeastasia.cloudapp.azure.com/api/goal/goalgraph  
select progress.progress_date, progress.progress_unit, progress.goal_id from progress where goal.goal_complete = 0  
// to plot the graph progress of each goal  
**params: user_id**  
![goalgraph](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/goalgraph.PNG)

get:  
http://melvin.southeastasia.cloudapp.azure.com/api/reward/rewardall  
```
SELECT * FROM goal.goal_reward ORDER BY reward_id
```
// display all rewards user have unlocked  

![rewardall](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/rewardall.PNG)

post:  
http://melvin.southeastasia.cloudapp.azure.com/api/reward/userreward  
```
SELECT user_reward.userReward_id, goal_reward.reward_id, goal_reward.reward_name, goal_reward.reward_description, goal_reward.reward_img
FROM goal.user_reward JOIN goal.goal_reward WHERE user_id = $user_id AND user_reward.reward_id = goal_reward.reward_id ORDER BY goal_reward.reward_id
```
// display all rewards user have unlocked  
**params: user_id**  
![userreward](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/userreward.PNG)

post:  
http://melvin.southeastasia.cloudapp.azure.com/api/reward/redeemreward  
When user select the reward. Check if user have already unlock the reward.  
//if have unlocked the reward, display the reward details  
//else check if total reward point is enough to unlock the reward  
//if total reward point is more than the required reward point, display the unlocked reward  
```
SELECT rewardpoint_total FROM goal.user WHERE user_id = $user_id
SELECT reward_unlock_pts FROM goal.goal_reward WHERE reward_id = $reward_id
SELECT userReward_id FROM goal.user_reward WHERE user_id = $user_id AND reward_id = $reward_id

if ($count == null){
      echo '{"error":"no result"}'
    }
    else {
        if ($reward_unlock_pts <= $rewardpoint_total){
          INSERT INTO goal.user_reward(user_id, reward_id) VALUES ($user_id, $reward_id)
          SELECT user_reward.userReward_id, goal_reward.reward_id, goal_reward.reward_name, goal_reward.reward_description, 
          goal_reward.reward_img FROM goal.user_reward JOIN goal.goal_reward WHERE user_reward.user_id = $user_id AND 
          user_reward.reward_id = $reward_id AND user_reward.reward_id = goal_reward.reward_id
          echo '{"NOTICE":"reward redeem"}'
        }

        else {
          echo '{"NOTICE":"not enough points to redeem"}'
        }

      }

      else {
        SELECT user_reward.userReward_id, goal_reward.reward_id, goal_reward.reward_name, goal_reward.reward_description, 
        goal_reward.reward_img FROM goal.user_reward JOIN goal.goal_reward WHERE user_reward.user_id = $user_id AND 
        user_reward.reward_id = $reward_id AND user_reward.reward_id = goal_reward.reward_id
        echo '{"NOTICE":"reward already redeemed"}'
      }
    }
```
**params: user_id, 
        reward_id**  
  
if total reward point is enough to unlock the reward or if user have already unlock the reward.  
![redeemreward1](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/redeemreward1.PNG)  
  
if total reward point is not to unlock the reward.  
![redeemreward2](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/redeemreward2.PNG)  

post:  
http://melvin.southeastasia.cloudapp.azure.com/api/reward/nextreward  
```
SELECT * FROM goal.goal_reward ORDER BY reward_id  
SELECT rewardpoint_total FROM goal.user WHERE user_id = $user_id

$point_till_unlock = $reward_unlock_pts - $rewardpoint_total;
$reward_to_reward = $reward_unlock_pts - $pre_reward_unlock_pts;
$reward_progress = $reward_to_reward - $point_till_unlock;
```
//reward progress bar for user to view the progress to unlock next reward  
**params: user_id**  
![nextreward](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/nextreward.PNG)

post:  
http://melvin.southeastasia.cloudapp.azure.com/api/user/countall  
select count goal_id where user_id = user_id and goal_complete = 0    
select count goal_id where user_id = user_id and goal_complete = 1  
select count goal_id where user_id = user_id  
select count rewardpoint_total where user_id = user_id  
//count goals in progress, goals completed, total goals, total reward points  
**params: user_id**  
![countall](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/countall.PNG)

post:  
http://melvin.southeastasia.cloudapp.azure.com/api/user/login  
select user_id, user_name where user_name = user_name and user_password = user_password  
**params: user_name, 
        user_password**  
![userlogin](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/userlogin.PNG)

get:  
http://melvin.southeastasia.cloudapp.azure.com/api/userall  
select all user  
To view user_id, user_name and user_password - for testing only  
![userall](https://raw.githubusercontent.com/melzzkwok/goal/my-edit/screenshot/userall.PNG)
        
