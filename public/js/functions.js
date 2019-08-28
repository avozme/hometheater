	/**
	 * Ask for confirmation before delete a movie from DB.
	 * Force chage location URL ir user say "yes"
	 * 
	 * @params Integer idMovie
	 */
	function deleteMovieConfirmation(idMovie) {
		if (confirm("¿Estás seguro de que deseas borrar esta película?\n(El archivo NO se eliminará del disco duro)")) {
			location.href="/movie/delete/" + idMovie;
		}
	}
	
	/**
	 * Ask for confirmation before scan and scap information for ONE single movie.
	 * 
	 * @returns True (confirmation OK) of False (cancel scanning)
	 */
	function scanMovieConfirmation() {
			if ($('#movieUrlInput').val() == "") {
				$('#movieUrlHelp').empty("");
				$('#movieUrlHelp').append("¡Escribe una URL válida!");
				$('#movieUrlInput').addClass("has-error");
				return false;
			}
			return confirm("Esta acción buscará los datos de la película en la URL señalada y sobreescribirá los existentes.\n\n¿Estás seguro de que quieres continuar?");
			
	}

	/**
	 * Ask for confirmation before scan an entire directory searching video files to scrap them.
	 * 
	 * @returns True (confirmation OK) of False (cancel scanning)
	 */
	function scanDirConfirmation() {
		if ($('#baseDir').val() == "") {
			$('#baseDirHelp').empty("");
			$('#baseDirHelp').append("¡Escribe un directorio válido!");
			$('#baseDir').addClass("has-error");
			return false;
		}
		return confirm("Esta acción lanzará una búsqueda en la ubicación señalada y añadirá los datos a la base de datos.\n\nEste proceso puede tardar varios minutos y no se puede deshacer.\n\n¿Estás seguro de que quieres continuar?");
	
	}

	/**
	 * Check if text input for search string is empty or not.
	 * If it's OK, launch search changing location, else show an error message
	 */ 
	function launchSearch() {
		searchString = $('#search').val();
		if (searchString == "") {
			$('#searchHelp').empty("");
			$('#searchHelp').append("¡Nada que buscar!");
			$('#search').addClass("has-error");
		} else {
			location.href='/movies/search/' + searchString;
		}
	}
