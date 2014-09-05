var Router = {
    urlForSaveIntoPrograms : WEBROOT+"puestos/addCoursesToProgram",
    urlForSearchList : WEBROOT+"lms/getList",
    urlForSave : WEBROOT+"lms/save",
    urlForSaveFacilityItem : WEBROOT+"lms/getFacilityItems",
    urlForSaveHierachy     : WEBROOT+"lms/savehierachy",
    urlForGetUnidadDeNegocio : WEBROOT+"lms/getHierachyItems/",
    urlForReadModel     : WEBROOT+"lms/readRecord",
    Colaboradores   :   {
        urlForReadExcelUsuarios  :   WEBROOT+"usuarios/readExcelUsuarios",
        urlForSaveExcelUsuarios  :   WEBROOT+"usuarios/saveArchivoUsuarios"
    },
    Grupos          :   {
        urlForProgramas          :  WEBROOT+"puestos/getProgramasPuestosInGrupo",
        urlForSaveProgramas          :  WEBROOT+"puestos/addProgramsToGroups",
        urlForSavePuestos          :  WEBROOT+"puestos/addPuestosToGroups",
        urlForDataGrupo          :  WEBROOT+"puestos/getProgramasPuestosInGrupo"
    }
};