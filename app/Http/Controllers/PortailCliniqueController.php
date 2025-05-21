namespace App\Http\Controllers;

use App\Models\Sinistre;
use App\Models\Prestation;
use App\Models\Ordonnance;
use Illuminate\Http\Request;

class PortailCliniqueController extends Controller
{
    // 🔍 1. Recherche de sinistres
    public function rechercherSinistre(Request $request)
    {
        $query = $request->input('query');
        $sinistres = Sinistre::where('numero_dossier', 'like', "%$query%")
            ->orWhere('patient_nom', 'like', "%$query%")
            ->with('prestations')
            ->get();

        return view('portail.recherche', compact('sinistres'));
    }

    // ✏️ 2. Rééditer une prestation
    public function editPrestation($id)
    {
        $prestation = Prestation::findOrFail($id);
        return view('portail.prestations.edit', compact('prestation'));
    }

    public function updatePrestation(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string',
            'details' => 'nullable|string',
            'prix' => 'nullable|numeric',
        ]);

        $prestation = Prestation::findOrFail($id);
        $prestation->update($request->only(['type', 'details', 'prix']));

        return redirect()->back()->with('success', 'Prestation mise à jour');
    }

    // ✅ 3. Compléter une prestation
    public function completerPrestation($id)
    {
        $prestation = Prestation::findOrFail($id);
        $prestation->completee = true;
        $prestation->save();

        return redirect()->back()->with('success', 'Prestation complétée');
    }

    // 💊 4. Prescrire une ordonnance
    public function creerOrdonnance($prestationId)
    {
        $prestation = Prestation::findOrFail($prestationId);
        return view('portail.ordonnances.create', compact('prestation'));
    }

    public function storeOrdonnance(Request $request, $prestationId)
    {
        $request->validate([
            'contenu' => 'required|string'
        ]);

        Ordonnance::create([
            'prestation_id' => $prestationId,
            'contenu' => $request->input('contenu')
        ]);

        return redirect()->back()->with('success', 'Ordonnance créée');
    }
}
