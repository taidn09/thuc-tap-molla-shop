if ($("#province").length) {
    const host = "https://provinces.open-api.vn/api/";
    var callAPI = (api) => {
        return $.ajax({
            url: api,
            method: "GET",
            dataType: "json"
        }).done(function(response) {
            renderData(response, "province");
            callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
        });
    };
    callAPI("https://provinces.open-api.vn/api/?depth=1");
    var callApiDistrict = (api) => {
        $("#province-is").val(
            $(`#province option[value="${$("#province").val()}"]`).data("name")
        );
        return $.ajax({
            url: api,
            method: "GET",
            dataType: "json"
        }).done(function(response) {
            renderData(response.districts, "district");
            callApiWard(host + "d/" + $("#district").val() + "?depth=2");
        });
    };
    var callApiWard = (api) => {
        $("#district-is").val(
            $(`#district option[value="${$("#district").val()}"]`).data("name")
        );
        return $.ajax({
            url: api,
            method: "GET",
            dataType: "json"
        }).done(function(response) {
            renderData(response.wards, "ward");
            $("#ward-is").val(
                $(`#ward option[value="${$("#ward").val()}"]`).data("name")
            );
        });
    };

    var renderData = (array, select) => {
        let row = "";
        const postition = JSON.parse(localStorage.getItem("address"));

        array.forEach((element, index) => {
            if (postition) {
                row += `<option value="${element.code}" ${
    postition[select] && postition[select] == element.name ? "selected" : null
  } data-name="${element.name}">${element.name}</option>`;
            } else {
                row += `<option value="${element.code}" data-name="${element.name}">${element.name}</option>`;
            }
        });
        $("#" + select).html(row);
    };

    $("#province").change(function() {
        callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
    });
    $("#district").change(function() {
        callApiWard(host + "d/" + $("#district").val() + "?depth=2");
    });
    $("#ward").change(function() {
        $("#ward-is").val($(`#ward option[value="${$("#ward").val()}"]`).data("name"));
    });
}