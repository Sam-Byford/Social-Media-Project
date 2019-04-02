<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 * Class for creating daily chat rooms
 */
class DailyChat
{	
	public function get_rand_chat() {
	    $chat_rooms = array(
            array('Every Day Issues', '<i class="fas fa-calendar-day"></i>', 'dailyIssue'),
            array('Health & Fitness', '<i class="fas fa-dumbbell"></i>', 'health/fitness'),
            array('Food & Drink', '<i class="fas fa-utensils"></i>', 'food/drink'),
            array('Money & Finance', '<i class="fas fa-money-bill-alt"></i>', 'money/finance'),
            array('Travel', '<i class="fas fa-plane-departure"></i>', 'travel'),
            array('General Uni Life', '<i class="fas fa-university"></i>', 'generalUniversity'),
            array('Relationships', '<i class="fas fa-heart"></i>', 'relationships'),
            array('Seasonal', '<i class="fas fa-sun"></i>', 'seasonal'),
            array('Sports', '<i class="fas fa-futbol"></i>', 'sports'),
            array('Gaming', '<i class="fas fa-gamepad"></i>', 'gaming'),
            array('News & Current Affairs', '<i class="fas fa-newspaper"></i>', 'news'),
            array('Books, Literature and Comics', '<i class="fas fa-books"></i>', 'readingBased'),
            array('Drinking & Nights Out', '<i class="fas fa-beer"></i>', 'drinking/seshing'),
            array('Memes', '<i class="fas fa-smile-wink"></i>', 'memes'),
            array('Grades & Advice', '<i class="fas fa-question"></i>', 'helpful'),
            array('What To Do After University', '<i class="fas fa-user-graduate"></i>', 'postgrad')
        );
        
        shuffle($chat_rooms);
        $fiveRandomRooms = array_slice($chat_rooms, 0, 5);
	    return $fiveRandomRooms;
	}
}