<?php

/*
*   author : Eray ARSLAN
*   web    : erayarslan.com
*/

require_once("Config.php");
require_once("Utils.php");

class Team {

    private $name;
    private $tag;
    private $createdDate;
    private $rating;
    private $country_code;
    private $webSite;
    private $currentRosterGame;

    private $playerOne;
    private $playerTwo;
    private $playerThree;
    private $playerFour;
    private $playerFive;

    private $captain;

    function __construct()
    {
        $teamArray = json_decode(get_data("https://api.steampowered.com/IDOTA2Match_570/GetTeamInfoByTeamID/v001/?key=".getApiKey()."&start_at_team_id=".getTeamId()."&teams_requested=1"),true);

        $this->name                 =   $teamArray["result"]["teams"][0]["name"];
        $this->tag                  =   $teamArray["result"]["teams"][0]["tag"];
        $this->createdDate          =   $teamArray["result"]["teams"][0]["time_created"];
        $this->rating               =   $teamArray["result"]["teams"][0]["rating"];
        $this->country_code         =   $teamArray["result"]["teams"][0]["country_code"];
        $this->webSite              =   $teamArray["result"]["teams"][0]["url"];
        $this->currentRosterGame    =   $teamArray["result"]["teams"][0]["games_played_with_current_roster"];

        $this->playerOne            =   $teamArray["result"]["teams"][0]["player_0_account_id"];
        $this->playerTwo            =   $teamArray["result"]["teams"][0]["player_1_account_id"];
        $this->playerThree          =   $teamArray["result"]["teams"][0]["player_2_account_id"];
        $this->playerFour           =   $teamArray["result"]["teams"][0]["player_3_account_id"];
        $this->playerFive           =   $teamArray["result"]["teams"][0]["player_4_account_id"];

        $this->captain              =   $teamArray["result"]["teams"][0]["admin_account_id"];
    }

    /**
     * @param mixed $captain
     */
    public function setCaptain($captain)
    {
        $this->captain = $captain;
    }

    /**
     * @return mixed
     */
    public function getCaptain()
    {
        return $this->captain;
    }

    /**
     * @param mixed $country_code
     */
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * @param mixed $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param mixed $currentRosterGame
     */
    public function setCurrentRosterGame($currentRosterGame)
    {
        $this->currentRosterGame = $currentRosterGame;
    }

    /**
     * @return mixed
     */
    public function getCurrentRosterGame()
    {
        return $this->currentRosterGame;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $playerFive
     */
    public function setPlayerFive($playerFive)
    {
        $this->playerFive = $playerFive;
    }

    /**
     * @return mixed
     */
    public function getPlayerFive()
    {
        return $this->playerFive;
    }

    /**
     * @param mixed $playerFour
     */
    public function setPlayerFour($playerFour)
    {
        $this->playerFour = $playerFour;
    }

    /**
     * @return mixed
     */
    public function getPlayerFour()
    {
        return $this->playerFour;
    }

    /**
     * @param mixed $playerOne
     */
    public function setPlayerOne($playerOne)
    {
        $this->playerOne = $playerOne;
    }

    /**
     * @return mixed
     */
    public function getPlayerOne()
    {
        return $this->playerOne;
    }

    /**
     * @param mixed $playerThree
     */
    public function setPlayerThree($playerThree)
    {
        $this->playerThree = $playerThree;
    }

    /**
     * @return mixed
     */
    public function getPlayerThree()
    {
        return $this->playerThree;
    }

    /**
     * @param mixed $playerTwo
     */
    public function setPlayerTwo($playerTwo)
    {
        $this->playerTwo = $playerTwo;
    }

    /**
     * @return mixed
     */
    public function getPlayerTwo()
    {
        return $this->playerTwo;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $webSite
     */
    public function setWebSite($webSite)
    {
        $this->webSite = $webSite;
    }

    /**
     * @return mixed
     */
    public function getWebSite()
    {
        return $this->webSite;
    }

} 