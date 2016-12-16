// populate people/states, also person/visit form submit
$(document).ready(function(){
	zendPopulatePeople();
	zendPopulateStates();
	displayData();

	$('#addPersonSubmit').click(function(e){
		e.preventDefault();
			addPerson();
	});

	$('#addVisitSubmit').click(function(e){
		e.preventDefault();
			addVisit();
	});
});

// display People Data
function displayData()
{
	$("#SelectHumanDropDown").change(function(){
		var selectedPerson = $("#SelectHumanDropDown").val();
		$.ajax({
			type: "GET",
			url: "api/people/" + selectedPerson,
			dataType: "json",
			success: function(data)
			{
				console.log(data);
				$("#PeopleInfo").empty();
				var firstName = data[0]["firstname"];
				var lastName = data[0]["lastname"];
				var food = data[0]["food"];
				var stateName = data[0]["statename"];
				var dateVisit = data[0]["date_visited"];

				if(firstName === null || lastName === null || food === null || stateName === null || dateVisit === null)
				{
					alert("You need to add a visit");
				}
				else
				{
					$("#PeopleInfo").append(
					"First name: " + firstName +
					"<br> Last name: " + lastName +
					"<br> Favorite food: " + food +
					"<br> Visited the State : " + stateName + " on " + dateVisit);
				}
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
		success: function(data)
		{
			alert("You have added a person");
			console.log(data);
			console.log($("#personForm").serialize());
			zendPopulatePeople();
			displayPeopleData();
		},
		error:function(data)
		{
			alert("Please fill out all inputs");
			console.log(data);
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
		success: function(data)
		{
			alert("You have added a visit");
			console.log(data);
			console.log($("#visitForm").serialize());
		},
		error: function(data)
		{
			alert("Please fill out all inputs");
			console.log(data);
			console.log($("#visitForm").serialize());
		}
	});
}
