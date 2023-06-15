<?php

class Skills
{
    private $interest;
    private $language;
    private $techtitle;
    private $database;
    private $userID;
    private $resumeID;

    public function __construct($interest, $language, $techtitle, $resumeID, $userID)
    {
        $this->interest = $interest;
        $this->language = $language;
        $this->techtitle = $techtitle;
        $this->userID = $userID;
        $this->resumeID = $resumeID;
        $this->database = new Database();
    }

    public function Createskills()
    {
        if (isset($this->userID)) {

            // Khaqan
            $connection = $this->database->connect();
            $interest = $this->getInterest();
            $language = $this->getLanguage();
            $techtitle = $this->getTechtitle();

            $sqleen = $connection->prepare(
                "INSERT INTO interests (interest, resumeID, userID)
                        Values (:interest, :resumeID, :userID);"
            );
            $sqltwee = $connection->prepare(
                "INSERT INTO languages (language, resumeID, userID)
                        Values (:language, :resumeID, :userID);"
            );
            $sqldrie = $connection->prepare(
                "INSERT INTO technical(techtitle, resumeID, userID)
                        Values (:techtitle, :resumeID, :userID);"
            );

            $sqleen->bindParam(":interest", $interest);
            $sqltwee->bindParam(":language", $language);
            $sqldrie->bindParam(":techtitle", $techtitle);
            $sqleen->bindParam(":userID", $this->userID);
            $sqleen->bindParam(":resumeID", $this->resumeID);
            $sqltwee->bindParam(":userID", $this->userID);
            $sqltwee->bindParam(":resumeID", $this->resumeID);
            $sqldrie->bindParam(":userID", $this->userID);
            $sqldrie->bindParam(":resumeID", $this->resumeID);
            $sqleen->execute();
            $sqltwee->execute();
            $sqldrie->execute();

        }


    }

    /**
     * @return mixed
     */
    public function getInterest()
    {
        return $this->interest;
    }

    /**
     * @param mixed $interest
     */
    public function setInterest($interest): void
    {
        $this->interest = $interest;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language): void
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getTechtitle()
    {
        return $this->techtitle;
    }

    /**
     * @param mixed $techtitle
     */
    public function setTechtitle($techtitle): void
    {
        $this->techtitle = $techtitle;
    }
}
