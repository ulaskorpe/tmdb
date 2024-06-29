
# TMDB API Project

this project is build for job application to Happy Horizon by Ulaş Körpe


 

## Installation

 
   git clone https://github.com/ulaskorpe/tmdb
   composer install 
   create your .env file and connect to your db 
   place your TMDB API KEY with name of  TMDB_API_KEY to .env file
   run : php artisan migrate --seed
    
## usage 


    When you install and run the project , you can login to panel with admin code : 130000 and password : secret
    I ve used free cms panel called ElaAdmin for presentation 
    TMDB connector is defined as a service under services/TMDBService , fetches required data from TMDB api 
    and required functions  to write related tables in database 
    For filling the db , i ve used commands , called on seeders . I ve used observers to fetch related data in chain from TMDB
    and created one method to create/update for each entity. 
    Genres of movies and series were different datasets so , I ve created them as   diffrent entities (Genre and GenreSeries)
    Movies has many genres related with a pivot table defined on its model  , when a movie fetched method looks for the same unique ID comes from TMDB and creates / updates the record with given data . 
    attaches the given genre data ( its checked if genre with same id exists in db.genres table)
    I ve used almost every data with same name fetched from each node in movies dataset 
    Series hasmany Seasons and seasons has many episodes , defined in their model 
    As same as movies when a series saved , it triggers series observer which fetches seasons data from TMDB 
    as a season saved it triggers seasons observer which fetches episodes data from TMDB
    # I ve ommited that line in observer for seeding takes so long 
    On admin panel , there are movies listed according to popularity DESC  , vote count DESC and vote average DESC 
    demostrated on a datatable to view details click on record

    for detail page gives other details about record
    find movies , triggers another function in TMDBService which fetches data according to given keyword , creates/updates movies given as results,  data given keep results in session until clear search button used 

    Series and seasons works in same way, only episodes are missing in db for seeding takes so long 
    I ve implamented a function in series detail page , a series given with its seasons demonstrated as bootstrap accordion
    under series info data , I ve placed a button runs a ajax function that fetches episodes data from TMDB  and places it to episodes table , it also updates if data is already among records. 

    For each record i ve created a slug field for user/seo friendly usage , creating slug with my GeneralHelper trait 

    Genres section , lists movie and series genres in datatables , returns the same view data is defined according to given type


    Commands:  
        I ve created seperate command for each entity , movies series seasons episodes and genres , you can always use them filling  or updating the database . They are also called in seeders 
        To use a related entities command , parameters are required like season_id , series_id 
        note: all id are matches with record id on  TMDB database 

    Database Structure :
        movies <--> genres
        series <--> genreSeries
        series <--> seasons <--> episodes 
        users : defines users who can login 

    API Collection :
        I ve placed tmdb.postman_collection.json file which i used to test TMDB api's , in projects folder

     





