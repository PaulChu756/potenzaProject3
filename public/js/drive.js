// populate people/states, also person/visit form submit
$(document).ready(function(){
	zendPopulatePeople();
	zendPopulateStates();
	displayPeopleData();
	displayStatesData();
	displayVisitsData();

	$('#addPersonSubmit').click(function(e){
		e.preventDefault();
		var checkFirstName = $.trim($('#firstName').val());
		var checkLastName = $.trim($('#lastName').val());
		var checkFavoriteFood = $.trim($('#favoriteFood').val());
		if(checkFirstName === '' || checkLastName === '' || checkFavoriteFood === '')
		{
			alert("Please fill out all input fields");
		}
		else
		{
			addPerson();
		}
	});

	$('#addVisitSubmit').click(function(e){
		e.preventDefault();
		var checkName = $.trim($('#humanNameDropDown').val());
		var checkState = $.trim($('#stateNameDropDown').val());
		var checkVisit = $.trim($('#dateVisit').val());
		if(checkName == '' || checkState == '' || checkVisit == '')
		{
			alert("Please fill out all input fields");
		}
		else
		{
			addVisit();
		}
	});
});

// display People Data
function displayPeopleData()
{
	$("#SelectHumanDropDown").change(function(){
		var i = $("#SelectHumanDropDown").val();
		var selectedPerson = i;
		$.ajax({
			type: "GET",
			url: "api/people/" + selectedPerson,
			dataType: "json",
			success: function(data)
			{
				$("#PeopleInfo").empty();
				var firstName = data[0]["firstname"];
				var lastName = data[0]["lastname"];
				var food = data[0]["food"];

				$("#PeopleInfo").append(
				"First name: " + firstName +
				"<br> Last name: " + lastName +
				"<br> Favorite food: " + food);
			}
		});
	});
}

//display States Data
function displayStatesData()
{
	$("#SelectHumanDropDown").change(function(){
		var i = $("#SelectHumanDropDown").val();
		var selectedPerson = i;
		$.ajax({
			type: "GET",
			url: "api/states/" + selectedPerson,
			dataType: "json",
			success: function(data)
			{
				$("#StatesInfo").empty();

				if(data == undefined)
				{
					alert("You need to add a visit");
				}

				$.each(data, function(i, item)
				{
					var stateName = data[i]["statename"];
					$("#StatesInfo").append("Visited the State : " + stateName);
				});
			}
		});
	});
}

//display Visits Data
function displayVisitsData()
{
	$("#SelectHumanDropDown").change(function(){
		var i = $("#SelectHumanDropDown").val();
		var selectedPerson = i;
		$.ajax({
			type: "GET",
			url: "api/visits/" + selectedPerson,
			dataType: "json",
			success: function(data)
			{
				$("#VisitsInfo").empty();

				if(data == undefined)
				{
					alert("You need to add a visit");
				}

				$.each(data, function(i, item)
				{
					var dateVisit = data[i]["date_visited"];
					$("#VisitsInfo").append(" on " + dateVisit);
				});
			}
		});
	});
}

//populate zendPeople's dropdowns
function zendPopulatePeople()
{
	$.ajax({
		type:"GET",
		url:"api/people",
		dataType:"json",
		success : function(data)
		{
			$("#SelectHumanDropDown option").not("#personOptions").remove();
			$("#humanNameDropDown option").not("#personOptions").remove();

			$.each(data, function(i,item)
			{
				$("#SelectHumanDropDown").append("<option value='" + data[i].id + "'>" + data[i].firstname + "</option>");
				$("#humanNameDropDown").append("<option value='" + data[i].id + "'>" + data[i].firstname + "</option>");
			});
		},
		error : function(data)
		{
			console.log('failed');
			console.log(data);
		}
	});
}

//populate zendState's dropdown
function zendPopulateStates()
{
	$.ajax({
		type:"GET",
		url:"api/states",
		dataType:"json",
		success : function(data)
		{
			$.each(data, function(i,item)
			{
				$("#stateNameDropDown").append("<option value='" + data[i].id + "'>" + data[i].statename + "</option>");
			});
		}
	});
}

//Add person to database
function addPerson()
{
	$.ajax({
		type: "POST",
		url: "api/people",
		data: $("#personForm").serialize(),
		dataType: "json",
		success: function(data)
		{
			console.log(data);
			console.log($("#personForm").serialize());
			alert("You have added a person");
			populatePeople();
			displayData();
		},
		error:function(data, status, xhr)
		{
			console.log(data);
			console.log(status);
			console.log(xhr);
			console.log($("#personForm").serialize());
		}
	});
}

//Add visit to database
function addVisit()
{
	$.ajax({
		type: "POST",
		url: "api/visits",
		data: $("#visitForm").serialize(),
		dataType: "json",
		success: function(data)
		{
			console.log(data);
			console.log($("#visitForm").serialize());
			alert("You have added a visit");
			//populatePeople();
			//displayData();
		}
	});
}
