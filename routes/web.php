<?php

use App\Http\Controllers\abonnementController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\authController;
use App\Http\Controllers\caracteristiqueController;
use App\Http\Controllers\categorieController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\compteController;
use App\Http\Controllers\depotController;
use App\Http\Controllers\employerController;
use App\Http\Controllers\etatController;
use App\Http\Controllers\factureController;
use App\Http\Controllers\formuleController;
use App\Http\Controllers\gerantController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\kitController;
use App\Http\Controllers\lavageController;
use App\Http\Controllers\livraisonController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\optionController;
use App\Http\Controllers\packController;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\planningController;
use App\Http\Controllers\posteController;
use App\Http\Controllers\receptController;
use App\Http\Controllers\recuController;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\setpController;
use App\Http\Controllers\sudoController;
use App\Http\Controllers\supplementController;
use App\Http\Controllers\tacheController;
use App\Http\Controllers\vetementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function(){

    Route::get('/dashboard',[authController::class, 'dashboard'])->name('dashboard');

    Route::prefix('/sudo')->group(function(){

        Route::get('/reinsert/gerant',[sudoController::class, 'reinsertGerants'])->name('reinsertGerants');
        Route::get('/form/reinsert/gerant/{formule}',[sudoController::class, 'formReinsertGerants'])->name('formReinsertGerants');
        Route::put('/put/reinsert/gerant/{formule}',[sudoController::class, 'putReinsertGerant'])->name('putReinsertGerant');

    });


    Route::prefix('/abonnement')->group(function(){
        Route::get('/accueil',[abonnementController::class, 'accueilAbonnement'])->name('accueilAbonnement');
    });

    Route::prefix('/compte')->group(function(){


        Route::get('/index',[compteController::class, 'indexCompteUser'])->name('indexCompteUser');
        Route::get('/modify/gerant/{gerant}',[compteController::class, 'modifyCompteGerant'])->name('modifyCompteGerant');
        Route::get('/modify/sudo/{sudo}',[compteController::class, 'modifyCompteSudo'])->name('modifyCompteSudo');
        Route::get('/modify/employer/{employer}',[compteController::class, 'modifyCompteEmployer'])->name('modifyCompteEmployer');
        Route::get('/modify/client/{client}',[compteController::class, 'modifyCompteClient'])->name('modifyCompteClient');
        Route::put('/put/gerant/{gerant}',[compteController::class, 'putCompteGerant'])->name('putCompteGerant');
        Route::put('/put/employer/{employer}',[compteController::class, 'putCompteEmployer'])->name('putCompteEmployer');
        Route::put('/put/sudo/{sudo}',[compteController::class, 'putCompteSudo'])->name('putCompteSudo');
        Route::put('/put/client/{client}',[compteController::class, 'putCompteClient'])->name('putCompteClient');

        Route::put('/modify/souscribe/{admin}',[abonnementController::class, 'putFinSouscribeAdmin'])->name('putFinSouscribeAdmin');


    });



    Route::prefix('/gerants')->group(function(){

        Route::get('/liste',[gerantController::class, 'listeGerant'])->name('listeGerant');
        Route::get('/detail/{gerant}',[gerantController::class, 'detailGerant'])->name('detailGerant');
        Route::get('/ajout',[gerantController::class, 'ajouterGerant'])->name('ajouterGerants');
        Route::get('/delete/{gerant}',[gerantController::class, 'deleteGerant'])->name('deleteGerant');
        Route::get('/modify/{gerant}',[gerantController::class, 'modifyGerant'])->name('modifyGerant');
        Route::put('/put/{gerant}',[gerantController::class, 'putGerant'])->name('putGerant');
        Route::get('/ajout/{formule}',[gerantController::class, 'showForm'])->name('showForm');
        Route::post('/ajout/{formule}',[gerantController::class, 'postGerant'])->name('postGerant');
        Route::put('/categories/modify/{gerant}',[gerantController::class, 'putCatGerant'])->name('putCatGerant');
        Route::put('/etats/modify/{gerant}',[gerantController::class, 'putEtatGerant'])->name('putEtatGerant');
        Route::get('/reabonner',[gerantController::class, 'reabonnerGerant'])->name('reabonnerGerants');
        Route::get('/reabonner/{formule}',[gerantController::class, 'reabonnerRecapGerant'])->name('reabonnerRecapGerant');
        Route::put('/put/reabonner/{gerant}',[gerantController::class, 'reabonnerPutGerant'])->name('reabonnerPutGerant');

    });

    Route::prefix('/employers')->group(function(){

        Route::get('/liste',[employerController::class, 'listeEmployers'])->name('listeEmployers');
        Route::get('/detail/{employer}',[employerController::class, 'detailEmployer'])->name('detailEmployer');
        Route::post('/ajout',[employerController::class, 'postEmployer'])->name('postEmployer');
        Route::get('/delete/{employer}',[employerController::class, 'deleteEmployer'])->name('deleteEmployer');
        Route::get('/all/delete',[employerController::class, 'deleteAllEmployer'])->name('deleteAllEmployer');
        Route::get('/modify/{employer}',[employerController::class, 'modifyEmployer'])->name('modifyEmployer');
        Route::put('/put/{employer}',[employerController::class, 'putEmployer'])->name('putEmployer');
        Route::put('/etats/modify/{employer}',[employerController::class, 'putEtatEmployer'])->name('putEtatEmployer');

    });

    Route::prefix('/clients')->group(function(){

        Route::get('/receptionist/liste',[ClientController::class, 'receptionistListeClient'])->name('receptionistListeClient');
        Route::get('/receptionist/ajout',[ClientController::class, 'receptionistAjoutClient'])->name('receptionistAjoutClient');
        Route::post('/receptionist/post',[ClientController::class, 'receptionistPostClient'])->name('receptionistPostClient');
        Route::get('/receptionist/detail/{client}',[ClientController::class, 'receptionistDetailClient'])->name('receptionistDetailClient');
        Route::put('/receptionist/etat/{client}',[ClientController::class, 'receptionistPutEtatClient'])->name('receptionistPutEtatClient');
        Route::get('/receptionist/modify/{client}',[ClientController::class, 'receptionistModifyClient'])->name('receptionistModifyClient');
        Route::put('/receptionist/put/{client}',[ClientController::class, 'receptionistPutClient'])->name('receptionistPutClient');

        Route::get('/gerant/liste',[ClientController::class, 'gerantListeClient'])->name('gerantListeClient');
        Route::get('/gerant/ajout',[ClientController::class, 'gerantAjoutClient'])->name('gerantAjoutClient');
        Route::post('/gerant/post',[ClientController::class, 'gerantPostClient'])->name('gerantPostClient');
        Route::get('/gerant/detail/{client}',[ClientController::class, 'gerantDetailClient'])->name('gerantDetailClient');
        Route::put('/gerant/etat/{client}',[ClientController::class, 'gerantPutEtatClient'])->name('gerantPutEtatClient');
        Route::get('/gerant/modify/{client}',[ClientController::class, 'gerantModifyClient'])->name('gerantModifyClient');
        Route::put('/gerant/put/{client}',[ClientController::class, 'gerantPutClient'])->name('gerantPutClient');
        Route::get('/gerant/delete/{client}',[ClientController::class, 'geantDeleteClient'])->name('geantDeleteClient');
        Route::get('/gerant/delete/all/',[ClientController::class, 'geantDeleteAllClient'])->name('geantDeleteAllClient');


    });


    Route::prefix('/formules')->group(function(){

        Route::get('/liste',[formuleController::class, 'listeFormules'])->name('listeFormules');
        Route::get('/detail/{formule}',[formuleController::class, 'detailFormule'])->name('detailFormule');
        Route::get('/delete/{formule}',[formuleController::class, 'deleteFormule'])->name('deleteFormule');
        Route::get('/modify/{formule}',[formuleController::class, 'modifyFormule'])->name('modifyFormule');
        Route::put('/modify/{formule}',[formuleController::class, 'putFormule'])->name('putFormule');
        Route::post('/ajout',[formuleController::class, 'postFormule'])->name('postFormule');
        Route::put('/etats/modify/{formule}',[formuleController::class, 'putEtatFormule'])->name('putEtatFormule');


    });

    Route::prefix('/etats')->group(function(){

        Route::get('/liste',[etatController::class, 'listeEtats'])->name('listeEtats');
        Route::post('/ajouter',[etatController::class, 'postEtatUser'])->name('postEtatUser');
        Route::post('/post',[etatController::class, 'postEtatFormule'])->name('postEtatFormule');
        Route::get('/detail/user/{etat_user}',[etatController::class, 'detailEtatUser'])->name('detailEtatUser');
        Route::get('/detail/formule/{etat_formule}',[etatController::class, 'detailEtatFormule'])->name('detailEtatFormule');
        Route::get('/delete/user/{etat_user}',[etatController::class, 'deleteEtatUser'])->name('deleteEtatUser');
        Route::get('/delete/formule/{etat_formule}',[etatController::class, 'deleteEtatFormule'])->name('deleteEtatFormule');
        Route::get('/modify/{etat_user}',[etatController::class, 'modifyEtatUser'])->name('modifyEtatUser');

    });


    Route::prefix('/categories')->group(function(){

        Route::get('/liste',[categorieController::class, 'listeCategories'])->name('listeCategories');
        Route::post('/ajouter/user/',[categorieController::class, 'postCatUser'])->name('postCatUser');
        Route::post('/ajouter/vetement/',[categorieController::class, 'postCatVet'])->name('postCatVet');
        Route::get('/details/user/{cat_user}',[categorieController::class, 'detailCatUser'])->name('detailCatUser');
        Route::get('/details/vetement/{cat_vet}',[categorieController::class, 'detailCatVet'])->name('detailCatVet');
        Route::get('/delete/vetement/{cat_vet}',[categorieController::class, 'deleteCatVet'])->name('deleteCatVet');
        Route::get('/modify/vetement/{cat_vet}',[categorieController::class, 'modifyCatVet'])->name('modifyCatVet');
        Route::put('/put/vetement/{cat_vet}',[categorieController::class, 'putCatVet'])->name('putCatVet');


    });


    Route::prefix('/caracteristiques')->group(function(){

        Route::get('/liste',[caracteristiqueController::class, 'listeCaracteristiques'])->name('listeCaracteristiques');
        Route::post('/ajouter/color/',[caracteristiqueController::class, 'postColor'])->name('postColor');
        Route::post('/ajouter/specification/',[caracteristiqueController::class, 'postSpVet'])->name('postSpVet');
        Route::post('/ajouter/quality/',[caracteristiqueController::class, 'postQualityVet'])->name('postQualityVet');
        Route::get('/details/color/{color_vet}',[caracteristiqueController::class, 'detailColor'])->name('detailColor');
        Route::get('/delete/color/{color_vet}',[caracteristiqueController::class, 'deleteColor'])->name('deleteColor');
        Route::get('/details/specification/{sp_vet}',[caracteristiqueController::class, 'detailSp'])->name('detailSp');
        Route::get('/delete/specification/{sp_vet}',[caracteristiqueController::class, 'deleteSp'])->name('deleteSp');

    });

    Route::prefix('/vetements')->group(function(){

        Route::get('/liste',[vetementController::class, 'listeVetements'])->name('listeVetements');
        Route::get('/ajout',[vetementController::class, 'ajouterVet'])->name('ajouterVet');
        Route::post('/post',[vetementController::class, 'postVet'])->name('postVet');
        Route::get('/delete/{vetement}',[vetementController::class, 'deleteVet'])->name('deleteVet');
        Route::get('/detail/{vetement}',[vetementController::class, 'detailVet'])->name('detailVet');
        Route::get('/all/delete',[vetementController::class, 'deleteAllVetement'])->name('deleteAllVetement');
        Route::get('/all/modify/{vetement}',[vetementController::class, 'modifyVet'])->name('modifyVet');
        Route::put('/all/put/{vetement}',[vetementController::class, 'putVet'])->name('putVet');

    });

    Route::prefix('/depots')->group(function(){

        Route::get('/accueil',[depotController::class, 'indexDepot'])->name('indexDepot');
        Route::get('/liste/poids',[depotController::class, 'listePoids'])->name('listePoids');
        Route::get('/liste/nombre',[depotController::class, 'listeNombre'])->name('listeNombre');
        Route::post('/poids',[depotController::class, 'postPoids'])->name('postPoids');
        Route::get('/poids/modify/{depot_poids}',[depotController::class, 'modifyPoids'])->name('modifyPoids');
        Route::get('/poids/delete/{depot_poids}',[depotController::class, 'deletePoids'])->name('deletePoids');
        Route::get('/nombre/delete/{depot_nombre}',[depotController::class, 'deleteNombre'])->name('deleteNombre');
        Route::get('/nombre/modify/{depot_nombre}',[depotController::class, 'modifyNombre'])->name('modifyNombre');
        Route::put('/poids/put/{depot_poids}',[depotController::class, 'putPoids'])->name('putPoids');
        Route::put('/nombre/put/{depot_nombre}',[depotController::class, 'putNombre'])->name('putNombre');
        Route::post('/nombre',[depotController::class, 'postNombre'])->name('postNombre');
        Route::post('/poids/recept',[depotController::class, 'postDepotPoidsRecept'])->name('postDepotPoidsRecept');
        Route::post('/nombre/recept',[depotController::class, 'postDepotNombreRecept'])->name('postDepotNombreRecept');

    });

    Route::prefix('/packs')->group(function(){

        Route::get('/accueil',[packController::class, 'accueilPacks'])->name('accueilPacks');
        Route::get('/nombre/form',[packController::class, 'formNombrePacks'])->name('formNombrePacks');
        Route::get('/nombre/liste',[packController::class, 'listePacksNombre'])->name('listePacksNombre');
        Route::get('/delete/nombre/{pack}',[packController::class, 'deletePackNombre'])->name('deletePackNombre');
        Route::put('put/nombre/{pack}',[packController::class, 'putPackNombre'])->name('putPackNombre');
        Route::get('/modify/nombre/{pack}',[packController::class, 'modifyPackNombre'])->name('modifyPackNombre');
        Route::post('/ajout/nombre',[packController::class, 'postPackNombre'])->name('postPackNombre');
        Route::get('/config/nombre/{pack}',[packController::class, 'configPackNombre'])->name('configPackNombre');
        Route::get('/detail/nombre/{pack}',[packController::class, 'detailPackNombre'])->name('detailPackNombre');
        Route::post('/post/vet/nombre/{pack}',[packController::class, 'postVetPackNombre'])->name('postVetPackNombre');
        Route::post('/post/CatVet/nombre/{pack}',[packController::class, 'postCatVetPackNombre'])->name('postCatVetPackNombre');
        Route::post('/post/QualityVet/nombre/{pack}',[packController::class, 'postQualityVetPackNombre'])->name('postQualityVetPackNombre');
        Route::get('/modify/vetement/nombre/{vetement}',[packController::class, 'modifyVetNombre'])->name('modifyVetNombre');
        Route::get('/modify/categorie/vetement/nombre/{cat_vet}',[packController::class, 'modifyCatVetNombre'])->name('modifyCatVetNombre');
        Route::get('/modify/quality/vetement/nombre/{quality_vet}',[packController::class, 'modifyQualityVetNombre'])->name('modifyQualityVetNombre');
        Route::get('/delete/vetement/nombre/{vetement}',[packController::class, 'deleteVetNombre'])->name('deleteVetNombre');
        Route::get('/delete/categorie/vetement/nombre/{cat_vet}',[packController::class, 'deleteCatVetNombre'])->name('deleteCatVetNombre');
        Route::get('/delete/quality/vetement/nombre/{quality_vet}',[packController::class, 'deleteQualityVetNombre'])->name('deleteQualityVetNombre');
        Route::put('/put/vetement/nombre/{vetement}',[packController::class, 'putVetNombre'])->name('putVetNombre');
        Route::put('/put/categorie/vetement/nombre/{cat_vet}',[packController::class, 'putCatVetNombre'])->name('putCatVetNombre');
        Route::put('/put/quality/vetement/nombre/{quality_vet}',[packController::class, 'putQualityVetNombre'])->name('putQualityVetNombre');


        Route::get('/poids/liste',[packController::class, 'listePacksPoids'])->name('listePacksPoids');
        Route::get('/poids/form',[packController::class, 'formPoidsPacks'])->name('formPoidsPacks');
        Route::post('/ajout/poids',[packController::class, 'postPackPoids'])->name('postPackPoids');
        Route::get('/config/poids/{pack}',[packController::class, 'configPackPoids'])->name('configPackPoids');
        Route::post('/post/vet/poids/{pack}',[packController::class, 'postVetPackPoids'])->name('postVetPackPoids');
        Route::post('/post/CatVet/poids/{pack}',[packController::class, 'postCatVetPackPoids'])->name('postCatVetPackPoids');
        Route::post('/post/QualityVet/poids/{pack}',[packController::class, 'postQualityVetPackPoids'])->name('postQualityVetPackPoids');
        Route::get('/detail/poids/{pack}',[packController::class, 'detailPackPoids'])->name('detailPackPoids');
        Route::get('/modify/vetement/poids/{vetement}',[packController::class, 'modifyVetPoids'])->name('modifyVetPoids');
        Route::put('/put/vetement/poids/{vetement}',[packController::class, 'putVetPoids'])->name('putVetPoids');
        Route::get('/delete/vetement/poids/{vetement}',[packController::class, 'deleteVetPoids'])->name('deleteVetPoids');
        Route::get('/modify/categorie/vetement/poids/{cat_vet}',[packController::class, 'modifyCatVetPoids'])->name('modifyCatVetPoids');
        Route::put('/put/categorie/vetement/poids/{cat_vet}',[packController::class, 'putCatVetPoids'])->name('putCatVetPoids');
        Route::get('/delete/categorie/vetement/poids/{cat_vet}',[packController::class, 'deleteCatVetPoids'])->name('deleteCatVetPoids');
        Route::get('/modify/quality/vetement/poids/{quality_vet}',[packController::class, 'modifyQualityVetPoids'])->name('modifyQualityVetPoids');
        Route::put('/put/quality/vetement/poids/{quality_vet}',[packController::class, 'putQualityVetPoids'])->name('putQualityVetPoids');
        Route::get('/delete/quality/vetement/poids/{quality_vet}',[packController::class, 'deleteQualityVetPoids'])->name('deleteQualityVetPoids');
        Route::get('/modify/poids/{pack}',[packController::class, 'modifyPackPoids'])->name('modifyPackPoids');
        Route::put('put/poids/{pack}',[packController::class, 'putPackPoids'])->name('putPackPoids');
        Route::get('/delete/poids/{pack}',[packController::class, 'deletePackPoids'])->name('deletePackPoids');



        Route::get('/receptionist/liste/client',[packController::class, 'receptionistListePackClient'])->name('receptionistListePackClient');




    });

    Route::prefix('/postes')->group(function(){

        Route::get('/liste',[posteController::class, 'listePostes'])->name('listePostes');
        Route::post('/ajout',[posteController::class, 'postPoste'])->name('postPoste');
        Route::get('/modify/{poste}',[posteController::class, 'modifyPoste'])->name('modifyPoste');
        Route::put('/put/{poste}',[posteController::class, 'putPoste'])->name('putPoste');
        Route::get('/gerant/delete',[posteController::class, 'geantTruncatePoste'])->name('geantTruncatePoste');

    });

    Route::prefix('/recept')->group(function(){

        Route::get('/liste',[receptController::class, 'listeRecept'])->name('listeRecept');
        Route::get('/accueil',[receptController::class, 'indexAllRecept'])->name('indexAllRecept');
        Route::get('/my/accueil',[receptController::class, 'indexMyRecept'])->name('indexMyRecept');
        Route::get('/formulaire',[receptController::class, 'typeRecept'])->name('typeRecept');
        Route::post('/ajout/{facture}',[receptController::class, 'postRecept'])->name('postRecept');
        Route::get('/liste/type',[receptController::class, 'listeTypeRecept'])->name('listeTypeRecept');
        Route::get('/delete/type/{vetement}',[receptController::class, 'deleteTypeRecept'])->name('deleteTypeRecept');
        Route::get('/all/delete/type',[receptController::class, 'deleteTypeAllRecept'])->name('deleteTypeAllRecept');
        Route::get('/delete/supplement/{vetement}',[receptController::class, 'deleteSupplementRecept'])->name('deleteSupplementRecept');
        Route::get('/all/delete/supplement',[receptController::class, 'deleteSupplementAllRecept'])->name('deleteSupplementAllRecept');
        Route::get('/delete/full/{vetement}',[receptController::class, 'deleteNombrePoidsRecept'])->name('deleteNombrePoidsRecept');
        Route::get('/all/delete/full',[receptController::class, 'deleteAllNombrePoidsRecept'])->name('deleteAllNombrePoidsRecept');
        Route::get('/liste/all',[receptController::class, 'listeNombrePoidsRecept'])->name('listeNombrePoidsRecept');
        Route::get('/liste/supplement',[receptController::class, 'listeSupplementRecept'])->name('listeSupplementRecept');
        Route::get('/liste/classic/{facture}',[receptController::class, 'receptFactureClassic'])->name('receptFactureClassic');
        Route::get('/liste/nombre/{facture}',[receptController::class, 'receptFactureNombre'])->name('receptFactureNombre');
        Route::get('/liste/poids/{facture}',[receptController::class, 'receptFacturePoids'])->name('receptFacturePoids');
        Route::get('/modify/classic/{vetement_classic}',[receptController::class, 'modifyVetReceptClassic'])->name('modifyVetReceptClassic');
        Route::get('/modify/nombre/{vetement_nombre}',[receptController::class, 'modifyVetReceptNombre'])->name('modifyVetReceptNombre');
        Route::get('/modify/poids/{vetement_poids}',[receptController::class, 'modifyVetReceptPoids'])->name('modifyVetReceptPoids');
        Route::put('/put/classic/{vetement_classic}',[receptController::class, 'putVetReceptClassic'])->name('putVetReceptClassic');
        Route::put('/put/nombre/{vetement_nombre}',[receptController::class, 'putVetReceptNombre'])->name('putVetReceptNombre');
        Route::put('/put/poids/{vetement_poids}',[receptController::class, 'putVetReceptPoids'])->name('putVetReceptPoids');
        Route::get('/liste/vetements/classic',[receptController::class, 'listVetReceptClassic'])->name('listVetReceptClassic');
        Route::get('/liste/vetements/nombre/{depot_nombre}',[receptController::class, 'listVetReceptNombre'])->name('listVetReceptNombre');
        Route::get('/liste/vetements/poids/{depot_poid}',[receptController::class, 'listVetReceptPoids'])->name('listVetReceptPoids');



    });


    Route::prefix('/factures')->group(function(){

        Route::get('/detail/receptionist/{facture}',[factureController::class, 'detailFactureReceptionist'])->name('detailFactureReceptionist');
        Route::get('/detail/client/{facture}',[factureController::class, 'detailFactureClient'])->name('detailFactureClient');
        Route::get('/liste/all',[factureController::class, 'listeAllFacture'])->name('listeAllFacture');
        Route::get('/Liste/my',[factureController::class, 'listeMyFacture'])->name('listeMyFacture');
        Route::get('/accueil',[factureController::class, 'accueilFacture'])->name('accueilFacture');
        Route::get('/liste',[factureController::class, 'listeFactureClassic'])->name('listeFactureClassic');
        Route::get('/liste/nombre',[factureController::class, 'listeDepotNombre'])->name('listeDepotNombre');
        Route::get('/liste/poids',[factureController::class, 'listeDepotPoids'])->name('listeDepotPoids');
        Route::get('/liste/nombre/{depot_nombre}',[factureController::class, 'listeFactureNombre'])->name('listeFactureNombre');
        Route::get('/liste/poids/{depot_poid}',[factureController::class, 'listeFacturePoids'])->name('listeFacturePoids');
        Route::post('/classic',[factureController::class, 'postFactureClassic'])->name('postFactureClassic');
        Route::put('/put/classic/{facture}',[factureController::class, 'putFactureClassic'])->name('putFactureClassic');
        Route::put('/put/nombre/{facture}',[factureController::class, 'putFactureNombre'])->name('putFactureNombre');
        Route::put('/put/poids/{facture}',[factureController::class, 'putFacturePoids'])->name('putFacturePoids');
        Route::post('/nombre/{depot_nombre}',[factureController::class, 'postFactureNombre'])->name('postFactureNombre');
        Route::post('/poids/{depot_poid}',[factureController::class, 'postFacturePoids'])->name('postFacturePoids');
        Route::post('/ajout',[factureController::class, 'postFacture'])->name('postFacture');
        Route::get('/edit/{facture}',[factureController::class, 'editFacture'])->name('editFacture');
        Route::get('/edit/classic/{facture}',[factureController::class, 'editFactureClassic'])->name('editFactureClassic');
        Route::get('/modify/classic/{facture}',[factureController::class, 'modifyFactureClassic'])->name('modifyFactureClassic');
        Route::get('/modify/nombre/{facture}',[factureController::class, 'modifyFactureNombre'])->name('modifyFactureNombre');
        Route::get('/modify/poids/{facture}',[factureController::class, 'modifyFacturePoids'])->name('modifyFacturePoids');
        Route::get('/edit/nombre/{facture}',[factureController::class, 'editFactureNombre'])->name('editFactureNombre');
        Route::get('/edit/poids/{facture}',[factureController::class, 'editFacturePoids'])->name('editFacturePoids');
        Route::put('/detail/recept/{facture}',[factureController::class, 'editDetailsRecept'])->name('editDetailsRecept');
        Route::get('/detail/gerant/{facture}',[factureController::class, 'detailFactureGerant'])->name('detailFactureGerant');
        Route::get('/modify/gerant/{facture}',[factureController::class, 'modifyFactureGerant'])->name('modifyFactureGerant');
        Route::put('/put/etat/{facture}',[factureController::class, 'putEtatFacture'])->name('putEtatFacture');
        Route::put('/put/facture/{facture}',[factureController::class, 'putFactureGerant'])->name('putFactureGerant');
        Route::get('/delete/{facture}',[factureController::class, 'deleteFactureGerant'])->name('deleteFactureGerant');
        Route::get('/all/delete',[factureController::class, 'deleteAllFactureGerant'])->name('deleteAllFactureGerant');

        Route::put('/put/gerant/etat/livraison/{facture}',[factureController::class, 'gerantPutEtatLivraison'])->name('gerantPutEtatLivraison');
        Route::put('/put/receptionist/etat/livraison/{facture}',[factureController::class, 'receptionistPutEtatLivraison'])->name('receptionistPutEtatLivraison');
        Route::put('/put/client/etat/livraison/{facture}',[factureController::class, 'clientPutEtatLivraison'])->name('clientPutEtatLivraison');
        Route::get('/receptionist/programming/livraison/{facture}',[factureController::class, 'receptionistProgrammingLivraison'])->name('receptionistProgrammingLivraison');

        Route::post('/ajout/programming/commune/{facture}',[factureController::class, 'postCommuneProgramming'])->name('postCommuneProgramming');
        Route::post('/ajout/programming/quartier/{facture}',[factureController::class, 'postQuartierProgramming'])->name('postQuartierProgramming');
        Route::post('/ajout/programming/adresse/{facture}',[factureController::class, 'postAdresseProgramming'])->name('postAdresseProgramming');
        Route::post('/ajout/programming/prix/{facture}',[factureController::class, 'postPrixProgramming'])->name('postPrixProgramming');
        Route::post('/livraison/programming{facture}',[factureController::class, 'postLivraisonProgramming'])->name('postLivraisonProgramming');


    });

    Route::prefix('/livraisons')->group(function(){

        Route::get('/liste',[livraisonController::class, 'ListeLivraison'])->name('ListeLivraison');
        Route::get('/detail/{livraison}',[livraisonController::class, 'detailLivraison'])->name('detailLivraison');
        Route::get('/delete/{livraison}',[livraisonController::class, 'deleteLivraison'])->name('deleteLivraison');
        Route::get('/liste/classic/{facture}',[livraisonController::class, 'listeLivraisonClassic'])->name('listeLivraisonClassic');
        Route::get('/liste/nombre/{facture}',[livraisonController::class, 'listeLivraisonNombre'])->name('listeLivraisonNombre');
        Route::get('/liste/poids/{facture}',[livraisonController::class, 'listeLivraisonPoids'])->name('listeLivraisonPoids');

        Route::post('/ajout/classic/commune/{facture}',[livraisonController::class, 'postCommuneClassic'])->name('postCommuneClassic');
        Route::post('/ajout/classic/quartier/{facture}',[livraisonController::class, 'postQuartierClassic'])->name('postQuartierClassic');
        Route::post('/ajout/classic/adresse/{facture}',[livraisonController::class, 'postAdresseClassic'])->name('postAdresseClassic');
        Route::post('/ajout/classic/prix/{facture}',[livraisonController::class, 'postPrixClassic'])->name('postPrixClassic');
        Route::post('/ajout/classic/{facture}',[livraisonController::class, 'postLivraisonClassic'])->name('postLivraisonClassic');
        Route::put('/put/classic/{livraison}',[livraisonController::class, 'putLivraisonClassic'])->name('putLivraisonClassic');

        Route::post('/ajout/poids/commune/{facture}',[livraisonController::class, 'postCommunePoids'])->name('postCommunePoids');
        Route::post('/ajout/poids/quartier/{facture}',[livraisonController::class, 'postQuartierPoids'])->name('postQuartierPoids');
        Route::post('/ajout/poids/adresse/{facture}',[livraisonController::class, 'postAdressePoids'])->name('postAdressePoids');
        Route::post('/ajout/poids/prix/{facture}',[livraisonController::class, 'postPrixPoids'])->name('postPrixPoids');
        Route::post('/ajout/poids/{facture}',[livraisonController::class, 'postLivraisonPoids'])->name('postLivraisonPoids');
        Route::put('/put/poids/{livraison}',[livraisonController::class, 'putLivraisonPoids'])->name('putLivraisonPoids');

        Route::post('/ajout/nombre/commune/{facture}',[livraisonController::class, 'postCommuneNombre'])->name('postCommuneNombre');
        Route::post('/ajout/nombre/quartier/{facture}',[livraisonController::class, 'postQuartierNombre'])->name('postQuartierNombre');
        Route::post('/ajout/nombre/adresse/{facture}',[livraisonController::class, 'postAdresseNombre'])->name('postAdresseNombre');
        Route::post('/ajout/nombre/prix/{facture}',[livraisonController::class, 'postPrixNombre'])->name('postPrixNombre');
        Route::post('/ajout/nombre/{facture}',[livraisonController::class, 'postLivraisonNombre'])->name('postLivraisonNombre');
        Route::put('/put/nombre/{livraison}',[livraisonController::class, 'putLivraisonNombre'])->name('putLivraisonNombre');


    });

    Route::prefix('/pdf')->group(function(){

        Route::get('/generate/{facture}',[pdfController::class, 'generatePdf'])->name('generatePdf');
        Route::get('/downlaod/facture/classic',[pdfController::class, 'downloadFactureClassic'])->name('downloadFactureClassic');
        Route::get('/downlaod/facture/nombre/{depot_nombre}',[pdfController::class, 'downloadFactureNombre'])->name('downloadFactureNombre');
        Route::get('/downlaod/facture/poids/{depot_poid}',[pdfController::class, 'downloadFacturePoids'])->name('downloadFacturePoids');
        Route::get('/downlaod/vetements/classic',[pdfController::class, 'downloadVetClassic'])->name('downloadVetClassic');
        Route::get('/downlaod/vetements/nombre/{depot_nombre}',[pdfController::class, 'downloadVetNombre'])->name('downloadVetNombre');
        Route::get('/downlaod/vetements/poids/{depot_poid}',[pdfController::class, 'downloadVetPoids'])->name('downloadVetPoids');
        Route::get('/downlaod/Vetements/my/recept/',[pdfController::class, 'downloadAllMyVetRecept'])->name('downloadAllMyVetRecept');
        Route::get('/downlaod/my/taches/',[pdfController::class, 'downloadMyTaches'])->name('downloadMyTaches');
        Route::get('/downlaod/my/recu/{recu}',[pdfController::class, 'downloadRecuMy'])->name('downloadRecuMy');

        Route::get('/receptionist/downlaod/facture/supplement/{service}',[pdfController::class, 'receptionistDownloadFactureSupplement'])->name('receptionistDownloadFactureSupplement');
        Route::get('/receptionist/downlaod/vetement/supplement/{service}',[pdfController::class, 'receptionistDownloadVetSupplement'])->name('receptionistDownloadVetSupplement');
        Route::get('/receptionist/downlaod/pdf/facture/supplement/{facture}',[pdfController::class, 'receptionistGeneratePdfFactureSupplement'])->name('receptionistGeneratePdfFactureSupplement');


        Route::get('/gerant/downlaod/facture/{facture}',[pdfController::class, 'gerantDownloadFacture'])->name('gerantDownloadFacture');
        Route::get('/gerant/downlaod/vetement/classic',[pdfController::class, 'gerantDownloadVetementClassic'])->name('gerantDownloadVetementClassic');
        Route::get('/gerant/downlaod/vetement/supplement',[pdfController::class, 'gerantDownloadVetementSupplement'])->name('gerantDownloadVetementSupplement');
        Route::get('/gerant/downlaod/vetement/full',[pdfController::class, 'gerantDownloadVetementNombrePoids'])->name('gerantDownloadVetementNombrePoids');
        Route::get('/gerant/downlaod/liste/livraison',[pdfController::class, 'gerantDownloadListeLivraison'])->name('gerantDownloadListeLivraison');


    });


    Route::prefix('/setp')->group(function(){

        Route::get('/liste',[setpController::class, 'listeSpet'])->name('listeSpet');
        Route::get('/view/{liste_facture}',[setpController::class, 'voirSetp'])->name('voirSetp');

    });


    Route::prefix('/planning')->group(function(){

        Route::get('/accueil',[planningController::class, 'indexPlanning'])->name('indexPlanning');
        Route::get('/reception',[planningController::class, 'planningRecep'])->name('planningRecep');
        Route::get('/lavage/{facture_lavage}',[planningController::class, 'planningLavage'])->name('planningLavage');
        Route::get('/repassage/{facture_repassage}',[planningController::class, 'planningRepassage'])->name('planningRepassage');
        Route::get('/livraison/{facture_livraison}',[planningController::class, 'planningLivraison'])->name('planningLivraison');
        Route::post('/edit/reception',[planningController::class, 'postPlanningRecep'])->name('postPlanningRecep');
        Route::post('/edit/lavage/{facture_lavage}',[planningController::class, 'postPlanningLavage'])->name('postPlanningLavage');
        Route::post('/edit/repassage/{facture_repassage}',[planningController::class, 'postPlanningRepassage'])->name('postPlanningRepassage');
        Route::post('/edit/livraison/{facture_livraison}',[planningController::class, 'postPlanningLivraison'])->name('postPlanningLivraison');
        Route::get('/lavage',[planningController::class, 'listeFactureLavage'])->name('listeFactureLavage');
        Route::get('/repassage',[planningController::class, 'listeFactureRepassage'])->name('listeFactureRepassage');
        Route::get('/livraison',[planningController::class, 'listeFactureLivraison'])->name('listeFactureLivraison');
        Route::get('/edit/lavage/{facture_lavage}',[planningController::class, 'editFactureLavage'])->name('editFactureLavage');

    });

    Route::prefix('/tache')->group(function(){

        Route::get('/myTache',[tacheController::class, 'indexMyTache'])->name('indexMyTache');
        Route::get('/AllTache',[tacheController::class, 'indexAllTache'])->name('indexAllTache');
        Route::put('/marquerAll/{tache}',[tacheController::class, 'marquerAllTache'])->name('marquerAllTache');
        Route::put('/marquerMy/{tache}',[tacheController::class, 'marquerMyTache'])->name('marquerMyTache');
        Route::get('/modify/{tache}',[tacheController::class, 'modifyTache'])->name('modifyTache');
        Route::put('/put/{tache}',[tacheController::class, 'putTache'])->name('putTache');
        Route::get('/delete/{tache}',[tacheController::class, 'deleteTache'])->name('deleteTache');
        Route::get('/all/delete',[tacheController::class, 'deleteAllTache'])->name('deleteAllTache');
        Route::get('/alldetail/{tache}',[tacheController::class, 'detailAllTache'])->name('detailAllTache');
        Route::get('/myDetail/{tache}',[tacheController::class, 'detailMyTache'])->name('detailMyTache');


    });


    Route::prefix('/recus')->group(function(){

        Route::get('/all/liste',[recuController::class, 'listeAllRecu'])->name('listeAllRecu');
        Route::get('/my/liste',[recuController::class, 'listeMyRecu'])->name('listeMyRecu');
        Route::get('all/detail/{recu}',[recuController::class, 'AllDetails'])->name('AllDetails');
        Route::get('all/delete/{recu}',[recuController::class, 'AllDelete'])->name('AllDelete');

    });


    Route::prefix('/options')->group(function(){

        Route::post('/vetement/classic',[optionController::class, 'postOptionVetClassic'])->name('postOptionVetClassic');
        Route::post('/color/classic',[optionController::class, 'postOptionColorClassic'])->name('postOptionColorClassic');
        Route::post('/specification/classic',[optionController::class, 'postOptionSpVetClassic'])->name('postOptionSpVetClassic');
        Route::post('/categorie/classic',[optionController::class, 'postOptionCatVetClassic'])->name('postOptionCatVetClassic');
        Route::post('/quality/classic',[optionController::class, 'postOptionQualityVetClassic'])->name('postOptionQualityVetClassic');

        Route::post('/vetement/nombre',[optionController::class, 'postOptionVetNombre'])->name('postOptionVetNombre');
        Route::post('/color/nombre',[optionController::class, 'postOptionColorNombre'])->name('postOptionColorNombre');
        Route::post('/specification/nombre',[optionController::class, 'postOptionSpVetNombre'])->name('postOptionSpVetNombre');
        Route::post('/categorie/nombre',[optionController::class, 'postOptionCatVetNombre'])->name('postOptionCatVetNombre');
        Route::post('/quality/nombre',[optionController::class, 'postOptionQualityVetNombre'])->name('postOptionQualityVetNombre');

        Route::post('/vetement/poids',[optionController::class, 'postOptionVetPoids'])->name('postOptionVetPoids');
        Route::post('/color/poids',[optionController::class, 'postOptionColorPoids'])->name('postOptionColorPoids');
        Route::post('/specification/poids',[optionController::class, 'postOptionSpVetPoids'])->name('postOptionSpVetPoids');
        Route::post('/categorie/poids',[optionController::class, 'postOptionCatVetPoids'])->name('postOptionCatVetPoids');
        Route::post('/quality/poids',[optionController::class, 'postOptionQualityVetPoids'])->name('postOptionQualityVetPoids');

    });


    Route::prefix('/services')->group(function(){

        Route::get('/liste',[serviceController::class, 'listeServices'])->name('listeServices');
        Route::post('/ajouter',[serviceController::class, 'postService'])->name('postService');
        Route::get('/modify/{service}',[serviceController::class, 'modifyService'])->name('modifyService');
        Route::put('/put/{service}',[serviceController::class, 'putService'])->name('putService');
        Route::get('/configuration/{service}',[serviceController::class, 'accueilConfigService'])->name('accueilConfigService');
        Route::post('/ajout/vetement/{service}',[serviceController::class, 'postVetService'])->name('postVetService');
        Route::get('/delete/{service}',[serviceController::class, 'deleteService'])->name('deleteService');
        Route::get('/modify/vetement/{vetement}',[serviceController::class, 'modifyVetService'])->name('modifyVetService');
        Route::get('/delete/vetement/{vetement}',[serviceController::class, 'deleteVetService'])->name('deleteVetService');
        Route::put('/put/vetement/{vetement}',[serviceController::class, 'putVetService'])->name('putVetService');

    });


    Route::prefix('/supplements')->group(function(){

        Route::get('/liste',[supplementController::class, 'listeSupplements'])->name('listeSupplements');
        Route::get('/receptionist/edit/facture/{service}',[supplementController::class, 'receptionistEditFacture'])->name('receptionistEditFacture');
        Route::post('/receptionist/post/facture/{service}',[supplementController::class, 'receptionistPostFacture'])->name('receptionistPostFacture');
        Route::get('/receptionist/recept/vetement/{facture}',[supplementController::class, 'receptionistReceptVetSupplement'])->name('receptionistReceptVetSupplement');
        Route::get('/receptionist/modify/facture/{facture}',[supplementController::class, 'receptionistModifyFactureSupplement'])->name('receptionistModifyFactureSupplement');
        Route::put('/receptionist/put/facture/{facture}',[supplementController::class, 'receptionistPutFactureSupplement'])->name('receptionistPutFactureSupplement');
        Route::get('/receptionist/list/vetement/recept/{service}',[supplementController::class, 'receptionistlistVetReceptSupplement'])->name('receptionistlistVetReceptSupplement');
        Route::post('/receptionist/post/vetement/{facture}',[supplementController::class, 'receptionistPostVetSupplement'])->name('receptionistPostVetSupplement');

        Route::post('/receptionist/post/option/vetement/{facture}',[supplementController::class, 'receptionistPostOptionVetSupplement'])->name('receptionistPostOptionVetSupplement');
        Route::post('/receptionist/post/option/color/{facture}',[supplementController::class, 'receptionistPostOptionColorSupplement'])->name('receptionistPostOptionColorSupplement');
        Route::post('/receptionist/post/option/spcification/{facture}',[supplementController::class, 'receptionistPostOptionSpVetSupplement'])->name('receptionistPostOptionSpVetSupplement');
        Route::post('/receptionist/post/option/categorie/{facture}',[supplementController::class, 'receptionistPostOptionCatVetSupplement'])->name('receptionistPostOptionCatVetSupplement');
        Route::post('/receptionist/post/option/quality/{facture}',[supplementController::class, 'receptionistPostOptionQualityVetSupplement'])->name('receptionistPostOptionQualityVetSupplement');

        Route::get('/receptionist/liste/detail/facture/{facture}',[supplementController::class, 'receptionistReceptFactureSupplement'])->name('receptionistReceptFactureSupplement');
        Route::put('receptionist/put/detail/facture/{facture}',[supplementController::class, 'receptionistEditDetailsReceptSupplement'])->name('receptionistEditDetailsReceptSupplement');
        Route::get('receptionist/modify/vetement/{vetement_supplement}',[supplementController::class, 'receptionistModifyVetReceptSupplement'])->name('receptionistModifyVetReceptSupplement');
        Route::put('receptionist/put/vetement/{vetement_supplement}',[supplementController::class, 'receptionistPutVetReceptSupplement'])->name('receptionistPutVetReceptSupplement');

        Route::get('receptionist/accueil/livaison/{facture}',[supplementController::class, 'receptionistlisteLivraisonSupplement'])->name('receptionistlisteLivraisonSupplement');
        Route::post('receptionist/post/option/commune/{facture}',[supplementController::class, 'receptionistPostCommuneSupplement'])->name('receptionistPostCommuneSupplement');
        Route::post('receptionist/post/option/quartier/{facture}',[supplementController::class, 'receptionistPostQuartierSupplement'])->name('receptionistPostQuartierSupplement');
        Route::post('receptionist/post/option/adresse/{facture}',[supplementController::class, 'receptionistPostAdresseSupplement'])->name('receptionistPostAdresseSupplement');
        Route::post('receptionist/post/option/prix/{facture}',[supplementController::class, 'receptionistPostPrixSupplement'])->name('receptionistPostPrixSupplement');
        Route::post('receptionist/post/livraion/{facture}',[supplementController::class, 'receptionistPostLivraisonSupplement'])->name('receptionistPostLivraisonSupplement');
        Route::put('receptionist/put/livraion/{livraison}',[supplementController::class, 'receptionistPutLivraisonSupplement'])->name('receptionistPutLivraisonSupplement');


    });


});


Route::get('/login',[loginController::class, 'login'])->name('login');
Route::post('/login',[loginController::class, 'postLogin'])->name('postLogin');

Route::get('/',[indexController::class, 'index'])->name('index');
Route::get('/suscribe/{formule}',[indexController::class, 'suscribeFormule'])->name('suscribeFormule');
Route::post('/post/suscribe/{formule}',[indexController::class, 'postSuscribe'])->name('postSuscribe');

Route::get('/logout',[loginController::class, 'logout'])->name('logout');

