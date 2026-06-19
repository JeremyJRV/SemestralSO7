<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * QuestionController
 * Gestiona CRUD de preguntas
 * Tipos: opción_múltiple, verdadero_falso
 */
class QuestionController extends Controller
{
    /**
     * Lista preguntas por tema y nivel
     */
    public function index(Request $request)
    {
        $query = Question::query();

        if ($request->has('theme_id')) {
            $query->where('theme_id', $request->theme_id);
        }

        if ($request->has('level_id')) {
            $query->where('level_id', $request->level_id);
        }

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $questions = $query->with(['options', 'theme', 'level'])->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $questions,
        ]);
    }

    /**
     * Obtiene una pregunta específica
     */
    public function show($id)
    {
        $question = Question::with(['options', 'theme', 'level'])->find($id);

        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Pregunta no encontrada',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $question,
        ]);
    }

    /**
     * Crea una nueva pregunta
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'theme_id' => 'required|exists:themes,id',
            'level_id' => 'required|exists:levels,id',
            'question_text' => 'required|string',
            'type' => 'required|in:opción_múltiple,verdadero_falso',
            'correct_answer_id' => 'required|integer',
            'explanation' => 'sometimes|string',
            'difficulty_score' => 'sometimes|integer|min:1|max:10',
            'options' => 'required|array',
            'options.*.option_text' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $question = Question::create([
            'theme_id' => $request->theme_id,
            'level_id' => $request->level_id,
            'question_text' => $request->question_text,
            'type' => $request->type,
            'correct_answer_id' => $request->correct_answer_id,
            'explanation' => $request->explanation ?? '',
            'difficulty_score' => $request->difficulty_score ?? 5,
            'is_active' => true,
        ]);

        // Crear opciones
        foreach ($request->options as $index => $optionData) {
            Option::create([
                'question_id' => $question->id,
                'option_text' => $optionData['option_text'],
                'order' => $index + 1,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pregunta creada exitosamente',
            'data' => $question->load('options'),
        ], 201);
    }

    /**
     * Actualiza una pregunta
     */
    public function update(Request $request, $id)
    {
        $question = Question::find($id);

        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Pregunta no encontrada',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'question_text' => 'sometimes|string',
            'explanation' => 'sometimes|string',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $question->update($request->only(['question_text', 'explanation', 'is_active']));

        return response()->json([
            'success' => true,
            'message' => 'Pregunta actualizada exitosamente',
            'data' => $question,
        ]);
    }

    /**
     * Elimina una pregunta
     */
    public function destroy($id)
    {
        $question = Question::find($id);

        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Pregunta no encontrada',
            ], 404);
        }

        $question->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pregunta eliminada exitosamente',
        ]);
    }
}