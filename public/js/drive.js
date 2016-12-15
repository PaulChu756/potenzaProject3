// populate people/states, also person/visit form submit
$(document).ready(function(){
	zendPopulatePeople();
	zendPopulateStates();
	displayPeopleData();
	displayStatesData();
	displayVisitsData();

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
function displayPeopleData()
{
	$("#SelectHumanDropDown").change(function(){
		var selectedPerson = $("#SelectHumanDropDown").val();
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
		var selectedPerson = $("#SelectHumanDropDown").val();
		$.ajax({
			type: "GET",
			url: "api/states/" + selectedPerson,
			dataType: "json",
			success: function(data)
			{
				var dataLength = data.length;
				$("#StatesInfo").empty();

				if(dataLength > 0)
				{
					$.each(data, function(e, item)
					{
						var stateName = data[e]["statename"];
						$("#StatesInfo").append("Visited the State : " + stateName);
					});
				}
				else
				{
					alert("You need to add a visit");
				}
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
