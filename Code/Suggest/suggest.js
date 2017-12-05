function init()
{
	obj = new Suggest();
	
	//Fetch and keep the movie and the container for later use
	obj.movie = document.getElementById("movie");
	obj.divcontainer = document.getElementById("container");
}

//Constructor for creating the Suggest functionality
function Suggest()
{
	//Timer for controlling calls to server
	this.timer = null;
	
	//XHR for call to server
	this.xhr = new XMLHttpRequest();
	
	//This function checks if the user has typed anything for 1s.
	// If something is typed, then the call to the server will
	// be postponed by 1s. If not, we check if the suggestions are
	// available in the cache. If yes, we render it from the cache.
	// Otherwise, we make a call to the server and fetch data from 
	// there.
	
	//This function fires on onkeyup
	this.getMovies = function()
	{
		//Check if a timer already exists. If so, cancel it
		// and register a new one. 
		if(this.timer)
		{
			clearTimeout(obj.timer);
		}
	
		//This will happen anyway
		this.timer = setTimeout(obj.fetchMovies, 1000);
	}

	//The fetchMovies function
	// This will check if the data is already in the cache. 
	// If so, it will render from the cache. Otherwise there will
	// be a visit to the server
	this.fetchMovies = function()
	{
		//Check if the movie is empty.
		// This can happen if the user repeatedly "backspaced"
		// and let go of the keyboard after making the field empty
		if(obj.movie.value == "")
		{
			//Nothing to do
			obj.divcontainer.innerHTML = "";
			obj.divcontainer.style.display = "none";
		}
		//Else, we have something typed. Lets check cache
		// and then go to server
		else
		{
			if(localStorage[obj.movie.value])
			{
				//Call showMovies
				obj.showMovies(JSON.parse(localStorage[obj.movie.value]));
		
			}
			else// We need to go to server
			{
				obj.xhr.onreadystatechange = obj.populateMovies;
		
				obj.xhr.open("GET", "http://localhost/movie_recommendation/Code/Suggest/getmovies.php?movie=" + obj.movie.value, true);
		
				obj.xhr.send();
				setTimeout(obj.Suggest,5000);
			}
		}
	} // fetchMovies over
	
	this.populateMovies = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			//Assuming JSON was sent by the server
			movies = JSON.parse(this.responseText);
			
			//Unfortunately no suggestions were offered
			if(movies.length == 0)
			{
				obj.movie.className = "notfound";
				//Clear the container div
				obj.divcontainer.innerHTML = "";
				obj.divcontainer.style.display = "none";
			}
	
			//Else, we found some suggestions. Lets load them
			else
			{
				obj.movie.className = "found";
			
				//Two things to take care now.
				// First thing is to show the suggestions.
				obj.showMovies(movies);
				
				//Cache the data we got. We can use it later
				//Lets use the localStorage for caching
				localStorage[obj.movie.value] = this.responseText;
			}
	
		}
	}//end populateMovies
	
	this.showMovies = function(movlist)
	{
		obj.divcontainer.innerHTML = "";
		
		//Add the movies to the divcontainer
		for(i=0;i<movlist.length;i++)
		{
			newdiv = document.createElement("div");
			newdiv.innerHTML = movlist[i];
			
			newdiv.className = "suggest";
			
			//Register the onclick event on the div
			newdiv.onclick = obj.setMovie;
		
			obj.divcontainer.appendChild(newdiv);

		}
		
		//Now
		obj.divcontainer.style.display = "block";
	}//end showMovies
	
	this.setMovie = function(event)
	{
		obj.movie.value = event.target.innerHTML;
		
		obj.divcontainer.innerHTML = "";
		obj.divcontainer.style.display = "none";
	}

}
