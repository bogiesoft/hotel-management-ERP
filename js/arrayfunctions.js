function manipulatearray(haystack,needle){
   for(i=0;i<haystack.length;i++){
    fliparray[i] = haystack[i];
   }
   haystack = adjustelement(haystack,needle);
   haystack[haystack.length] = needle;
   var container = [];
   container[0] = haystack;
   container[1] = fliparray;
   return container;
  }

function adjustelement(haystack,needle){
  spot = needle;
  if(isNaN(needle)){
    spot = spotelement(haystack,needle);
  }
  haystack = delelement(haystack,spot);
  for(i=spot;i<haystack.length;i++){
      if(i!=(haystack.length-1))haystack[i] = haystack[i+1];
      else haystack.length = i;
  }
 return haystack;
}

function delelement(haystack,spot){
    haystack[spot] = null;
    return haystack;
}

function spotelement(haystack,needle){
  var j = null;
   for(i=0;i<haystack.length;i++){
     if(haystack[i] == needle){
       j = i;
     }
  }
  return j;
}

function populatearray(arrayA, arrayB) {
    if (parentnode == 'mprototypes') {
        var adultarray = [];
        var childarray = [];
        for (var i = 0; i < 6; i++) {
            adultarray[adultarray.length] = $('#adult' + i).val();
            childarray[childarray.length] = $('#child' + i).val();
        }
        adultarray[adultarray.length] = $('#adultunit').val();
        childarray[childarray.length] = $('#childunit').val();

        var weekarray = [];
        for (var i = 0; i < 7; i++) {
            weekarray[i] = $('#week' + i).attr('checked');
        }

    }

    arrayA = [obj.length+1];
    //console.log("for loop runs " + (arrayB.length-1)+" times");
    for (i = 1; i < arrayB.length; i++) {
        //console.log(arrayB+"\n")
        //console.log(arrayB[i]);
            if (arrayB[i] == 'Image') {
                arrayA[arrayA.length] = 'images/roomimages/' + typecreated;
            }
            else if (arrayB[i] == 'Rate per Adult') {
                arrayA[arrayA.length] = JSON.stringify(adultarray);
            }
            else if (arrayB[i] == 'Available Days') {
                arrayA[arrayA.length] = JSON.stringify(weekarray);
            }
            else if (arrayB[i] == 'Rate per Child') {
                arrayA[arrayA.length] = JSON.stringify(childarray);
            }
            else if (arrayB[i] == 'status') {
                if (document.getElementById(arrayB[i]).checked) {arrayA[i] = 1;} 
                else { arrayA[i] = 0; }
            }
            else  arrayA[arrayA.length] = document.getElementById(arrayB[i]).value;
            //console.log("the length of array is :--"+arrayA.length+"and array is "+arrayA);
        }
    arrayA = JSON.stringify(arrayA);
    console.log(arrayA);
  return arrayA;
}
